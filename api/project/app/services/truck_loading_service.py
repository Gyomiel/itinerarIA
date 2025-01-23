import pandas as pd
import numpy as np
from sklearn.cluster import KMeans
import folium
import pymysql
import pygad
from ..config import settings
import logging

logger = logging.getLogger(__name__)

def optimize_truck_loading():
    """
    Optimiza la carga de los camiones usando clustering
    """
    try:
        # Conexión a la base de datos MySQL
        conn = pymysql.connect(
            host=settings.DB_HOST,
            user=settings.DB_USER,
            password=settings.DB_PASSWORD,
            database=settings.DB_DATABASE
        )

        cursor = conn.cursor()

        # Consultas a la base de datos
        query_truck = "SELECT id, license_plate, max_mass, max_volume FROM truck"
        cursor.execute(query_truck)
        df_truck = pd.DataFrame(cursor.fetchall(), columns=["id", "license_plate", "max_mass", "max_volume"])

        query_order = "SELECT id, maximum_permissible_mass, maximum_permissible_volume, longitude, latitude FROM `order`"
        cursor.execute(query_order)
        df_order = pd.DataFrame(cursor.fetchall(),
                            columns=["id", "maximum_permissible_mass", "maximum_permissible_volume", "longitude",
                                     "latitude"])

        # Preparación de datos
        df_order["maximum_permissible_mass"] = pd.to_numeric(df_order["maximum_permissible_mass"], errors="coerce")
        df_order["maximum_permissible_volume"] = pd.to_numeric(df_order["maximum_permissible_volume"], errors="coerce")
        df_order.dropna(subset=["maximum_permissible_mass", "maximum_permissible_volume"], inplace=True)
        df_order['uploaded'] = False

        # Parámetros del clustering con centroides específicos
        n_clusters = settings.N_CLUSTERS
        cluster_centers = np.array([
            (28.135035564504964, -15.43209759947092),  # Sitio A
            (28.11873238338806, -15.52326563195904),   # Sitio B
            (28.14414695029059, -15.655172960469848),  # Sitio C
            (28.100333635665432, -15.705940715919775), # Sitio D
            (28.039781912565754, -15.572606885537912), # Sitio E
            (27.99972252231642, -15.41705962589178),  # Sitio F
            (27.91787907070111, -15.432363893330333),  # Sitio G
            (27.770627079086285, -15.605982396663174)  # Sitio H
        ])

        # Aplicar K-Means
        kmeans = KMeans(n_clusters=n_clusters, init=cluster_centers, n_init=1, random_state=666)
        df_order['cluster'] = kmeans.fit_predict(df_order[["latitude", "longitude"]])

        # Crear diccionarios para resultados
        clusters = {f'cluster_{i}': df_order[df_order['cluster'] == i].copy() for i in range(n_clusters)}
        orders_in_trucks = {}
        volume_truck_used = {}

        # Diccionario para seguimiento del uso de cada camión
        truck_usage = {truck['license_plate']: {'mass': 0, 'volume': 0} for _, truck in df_truck.iterrows()}

        def can_fit_in_truck(cluster_df, truck_data, truck_id):
            total_mass = cluster_df['maximum_permissible_mass'].sum()
            total_volume = cluster_df['maximum_permissible_volume'].sum()

            current_usage = truck_usage[truck_id]
            remaining_mass_capacity = truck_data['max_mass'] - current_usage['mass']
            remaining_volume_capacity = truck_data['max_volume'] - current_usage['volume']

            return (total_mass <= remaining_mass_capacity * 0.99 and
                    total_volume <= remaining_volume_capacity * 0.99)

        def fitness_function(ga_instance, solution, solution_idx, remaining_clusters, truck_data, truck_id):
            total_mass = truck_usage[truck_id]['mass']
            total_volume = truck_usage[truck_id]['volume']

            for i, use_cluster in enumerate(solution):
                if use_cluster == 1:
                    cluster_df = remaining_clusters[i]
                    cluster_mass = cluster_df['maximum_permissible_mass'].sum()
                    cluster_volume = cluster_df['maximum_permissible_volume'].sum()

                    if (total_mass + cluster_mass > truck_data['max_mass'] * 0.99 or
                            total_volume + cluster_volume > truck_data['max_volume'] * 0.99):
                        return 0

                    total_mass += cluster_mass
                    total_volume += cluster_volume

            volume_utilization = total_volume / truck_data['max_volume']
            mass_utilization = total_mass / truck_data['max_mass']

            return (volume_utilization + mass_utilization) / 2

        def verify_assignment(cluster_df, truck_id, truck_data):
            """
            Verificación final antes de asignar un cluster
            """
            total_mass = cluster_df['maximum_permissible_mass'].sum()
            total_volume = cluster_df['maximum_permissible_volume'].sum()

            current_usage = truck_usage[truck_id]
            final_mass = current_usage['mass'] + total_mass
            final_volume = current_usage['volume'] + total_volume

            if final_mass > truck_data['max_mass'] or final_volume > truck_data['max_volume']:
                logger.warning(f"Asignación rechazada para camión {truck_id}:")
                logger.warning(f"Masa final: {final_mass}/{truck_data['max_mass']}")
                logger.warning(f"Volumen final: {final_volume}/{truck_data['max_volume']}")
                return False
            return True

        def verify_total_truck_usage(truck_id, df_truck):
            """
            Verifica que el uso total del camión no exceda sus límites
            """
            usage = truck_usage[truck_id]
            truck_data = df_truck[df_truck['license_plate'] == truck_id].iloc[0]

            mass_percentage = (usage['mass'] / truck_data['max_mass']) * 100
            volume_percentage = (usage['volume'] / truck_data['max_volume']) * 100

            return mass_percentage <= 100 and volume_percentage <= 100

        def update_truck_usage(truck_id, mass, volume):
            """
            Actualiza el uso del camión
            """
            truck_usage[truck_id]['mass'] += mass
            truck_usage[truck_id]['volume'] += volume

        def assign_cluster_to_truck(cluster_df, truck_id, truck_data, cluster_id):
            """
            Asigna un cluster completo a un camión
            """
            total_mass = cluster_df['maximum_permissible_mass'].sum()
            total_volume = cluster_df['maximum_permissible_volume'].sum()

            current_usage = truck_usage[truck_id]
            if (current_usage['mass'] + total_mass > truck_data['max_mass'] or
                    current_usage['volume'] + total_volume > truck_data['max_volume']):
                logger.error(f"¡Error! El cluster {cluster_id} excede la capacidad del camión {truck_id}.")
                return False

            update_truck_usage(truck_id, total_mass, total_volume)

            truck_key = f"Truck_{truck_id}_cluster_{cluster_id}"
            orders_in_trucks[truck_key] = cluster_df['id'].tolist()
            volume_truck_used[truck_key] = {
                'volume_used': total_volume,
                'volume_capacity': truck_data['max_volume'],
                'mass_used': total_mass,
                'mass_capacity': truck_data['max_mass']
            }

            df_order.loc[df_order['cluster'] == cluster_id, 'uploaded'] = True
            return True

        # Proceso principal de asignación
        available_clusters = list(range(n_clusters))
        trucks_list = df_truck['license_plate'].tolist()
        current_truck_index = 0

        while available_clusters and current_truck_index < len(trucks_list):
            current_truck_id = trucks_list[current_truck_index]
            current_truck = df_truck[df_truck['license_plate'] == current_truck_id].iloc[0]

            first_cluster = available_clusters[0]
            first_cluster_df = clusters[f'cluster_{first_cluster}']

            if can_fit_in_truck(first_cluster_df, current_truck, current_truck_id):
                assign_cluster_to_truck(first_cluster_df, current_truck_id, current_truck, first_cluster)
                available_clusters.remove(first_cluster)

                remaining_clusters_data = [clusters[f'cluster_{i}'] for i in available_clusters]

                if remaining_clusters_data:
                    ga_instance = pygad.GA(
                        num_generations=100,
                        num_parents_mating=5,
                        fitness_func=lambda ga, sol, idx: fitness_function(
                            ga, sol, idx, remaining_clusters_data, current_truck, current_truck_id
                        ),
                        sol_per_pop=20,
                        num_genes=len(remaining_clusters_data),
                        gene_space=[0, 1],
                        crossover_type="single_point",
                        mutation_type="random",
                        mutation_probability=0.1
                    )
                    ga_instance.run()
                    solution, solution_fitness, _ = ga_instance.best_solution()

                    if solution_fitness > 0:
                        selected_indices = [i for i, val in enumerate(solution) if val == 1]
                        selected_indices = [idx for idx in selected_indices if idx < len(available_clusters)]

                        for idx in selected_indices:
                            if idx >= len(available_clusters):
                                logger.warning(f"Índice {idx} fuera de rango. Longitud actual de available_clusters: {len(available_clusters)}")
                                continue

                            cluster_id = available_clusters[idx]
                            cluster_df = clusters[f'cluster_{cluster_id}']
                            if assign_cluster_to_truck(cluster_df, current_truck_id, current_truck, cluster_id):
                                available_clusters.remove(cluster_id)

            current_truck_index += 1

        # Crear visualización
        map_center = [df_order['latitude'].mean(), df_order['longitude'].mean()]
        map_clusters = folium.Map(location=map_center, zoom_start=12)

        colors = ['red', 'blue', 'green', 'purple', 'orange', 'darkred', 'lightblue', 'pink']

        # Agregar marcadores de pedidos
        for cluster_id in range(n_clusters):
            cluster_color = colors[cluster_id]
            cluster_data = df_order[df_order['cluster'] == cluster_id]

            for _, row in cluster_data.iterrows():
                status = "Asignado" if row['uploaded'] else "No asignado"
                folium.CircleMarker(
                    location=(row['latitude'], row['longitude']),
                    radius=5,
                    color=cluster_color,
                    fill=True,
                    fill_opacity=0.7,
                    popup=f"ID: {row['id']}<br>Volume: {row['maximum_permissible_volume']:.2f}<br>Mass: {row['maximum_permissible_mass']:.2f}<br>Status: {status}"
                ).add_to(map_clusters)

        # Agregar centroides
        for i, center in enumerate(cluster_centers):
            folium.CircleMarker(
                location=(center[0], center[1]),
                radius=8,
                color='black',
                fill=True,
                popup=f'Centroide {i}',
                weight=2
            ).add_to(map_clusters)

        map_clusters.save("clusters_map.html")

        # Actualizar route_id en la base de datos y preparar resultados
        results = {
            "assignments": [],
            "truck_usage": [],
            "unassigned_orders": []
        }

        for truck_key, orders in orders_in_trucks.items():
            truck_license = truck_key.split('_')[1]
            truck_id = df_truck[df_truck['license_plate'] == truck_license]['id'].iloc[0]
            route_id = get_route_id(truck_id)
            
            if route_id:
                # Actualizar los pedidos con el route_id
                for order_id in orders:
                    update_order_route(order_id, route_id)
                
                assignment = {
                    "truck_key": truck_key,
                    "truck_id": int(truck_id),
                    "route_id": int(route_id),
                    "orders": orders
                }
                
                usage = volume_truck_used[truck_key]
                usage_info = {
                    "truck_id": truck_license,
                    "volume_used_percent": (usage['volume_used'] / usage['volume_capacity'] * 100),
                    "mass_used_percent": (usage['mass_used'] / usage['mass_capacity'] * 100)
                }
                
                results["assignments"].append(assignment)
                results["truck_usage"].append(usage_info)

        # Verificar pedidos no asignados
        unassigned_orders = df_order[~df_order['uploaded']]['id'].tolist()
        results["unassigned_orders"] = unassigned_orders

        conn.close()
        return results

    except Exception as e:
        logger.error(f"Error en optimize_truck_loading: {str(e)}", exc_info=True)
        raise