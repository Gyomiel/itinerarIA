import logging
import requests
import pandas as pd
import mysql.connector
from math import radians, sin, cos, sqrt, atan2
from ..config import settings

logger = logging.getLogger(__name__)

def optimize_routes():
    try:
        # Configuración inicial
        warehouse_location = {"lat": settings.WAREHOUSE_LAT, "lng": settings.WAREHOUSE_LNG}

        # Configuración de la base de datos
        DB_CONFIG = {
            "host": settings.DB_HOST,
            "user": settings.DB_USER,
            "password": settings.DB_PASSWORD,
            "database": settings.DB_DATABASE
        }

        def calculate_distance(point1, point2):
            R = 6371e3
            lat1, lon1 = radians(point1[0]), radians(point1[1])
            lat2, lon2 = radians(point2[0]), radians(point2[1])
            dlat = lat2 - lat1
            dlon = lon2 - lon1
            a = sin(dlat / 2) ** 2 + cos(lat1) * cos(lat2) * sin(dlon / 2) ** 2
            c = 2 * atan2(sqrt(a), sqrt(1 - a))
            return R * c

        def greedy_route(start_point, locations):
            remaining = locations[:]
            route = []
            current_point = start_point
            while remaining:
                next_point = min(remaining, key=lambda loc: calculate_distance(
                    (current_point["lat"], current_point["lng"]),
                    (loc["lat"], loc["lng"])
                ))
                route.append(next_point)
                remaining.remove(next_point)
                current_point = next_point
            return route

        routes_results = []

        # Obtener todas las rutas disponibles de la tabla "route"
        with mysql.connector.connect(**DB_CONFIG) as conn:
            with conn.cursor(dictionary=True) as cursor:
                cursor.execute("SELECT id FROM `route`")
                routes = cursor.fetchall()

            if not routes:
                logger.warning("No hay rutas disponibles en la base de datos.")
                return {"message": "No hay rutas disponibles"}

            # Procesar cada ruta
            for route in routes:
                ROUTE_ID = route['id']
                logger.info(f"Procesando pedidos para la ruta con route_id = {ROUTE_ID}...")

                # Obtener los pedidos asociados a la ruta actual
                with conn.cursor(dictionary=True) as cursor:
                    cursor.execute("""
                        SELECT id, latitude AS lat, longitude AS lng
                        FROM `order`
                        WHERE route_id = %s
                    """, (ROUTE_ID,))
                    order_locations = cursor.fetchall()

                if not order_locations:
                    logger.warning(f"No hay pedidos asignados a la ruta con route_id = {ROUTE_ID}.")
                    continue

                # Convertir Decimal a float
                for loc in order_locations:
                    loc["lat"] = float(loc["lat"])
                    loc["lng"] = float(loc["lng"])

                # Crear la ruta optimizada
                sorted_locations = greedy_route(warehouse_location, order_locations)

                # Preparar datos para GraphHopper
                vehicle = {
                    "vehicle_id": f"vehicle_{ROUTE_ID}",
                    "start_address": {
                        "location_id": "warehouse",
                        "lon": warehouse_location["lng"],
                        "lat": warehouse_location["lat"]
                    }
                }

                services = []
                for loc in sorted_locations:
                    services.append({
                        "id": str(loc["id"]),
                        "address": {
                            "location_id": str(loc["id"]),
                            "lon": loc["lng"],
                            "lat": loc["lat"]
                        }
                    })

                payload = {"vehicles": [vehicle], "services": services}
                headers = {"Content-Type": "application/json"}

                response = requests.post(
                    f"{settings.API_URL_OPTIMIZATION}?key={settings.API_KEY}",
                    json=payload,
                    headers=headers
                )
                if response.status_code == 200:
                    data = response.json()
                    route_order = []
                    for route in data["solution"]["routes"]:
                        for activity in route["activities"]:
                            if activity["type"] == "service":
                                route_order.append(activity["id"])

                    # Crear un DataFrame con los resultados
                    df_data = []
                    for loc in sorted_locations:
                        df_data.append({
                            "id": route_order.index(str(loc["id"])) + 1 if str(loc["id"]) in route_order else None,
                            "id_order": loc["id"],
                            "latitude": loc["lat"],
                            "longitude": loc["lng"]
                        })

                    df = pd.DataFrame(df_data)

                    # Ordenar el DataFrame por la columna 'id'
                    df = df.sort_values(by="id").reset_index(drop=True)

                    # Actualizar los resultados en la columna "sequence" de la tabla "order"
                    for _, row in df.iterrows():
                        with conn.cursor() as cursor:
                            cursor.execute("""
                                UPDATE `order`
                                SET sequence = %s
                                WHERE id = %s
                            """, (row["id"], row["id_order"]))
                            conn.commit()

                    route_result = {
                        "route_id": ROUTE_ID,
                        "order_sequence": df.to_dict('records'),
                        "status": "optimized"
                    }
                    routes_results.append(route_result)
                    logger.info(f"Ruta {ROUTE_ID} optimizada exitosamente")
                else:
                    logger.error(f"Error en la API de GraphHopper para route_id {ROUTE_ID}: {response.status_code} - {response.text}")
                    route_result = {
                        "route_id": ROUTE_ID,
                        "status": "error",
                        "error": f"GraphHopper API error: {response.status_code}"
                    }
                    routes_results.append(route_result)

        return {
            "total_routes_processed": len(routes),
            "routes_results": routes_results
        }

    except Exception as e:
        logger.error(f"Error en optimize_routes: {str(e)}", exc_info=True)
        raise