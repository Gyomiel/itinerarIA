from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from project.app.api.endpoints import router
import pymysql
import pandas as pd
import pygad
from sklearn.cluster import KMeans
import folium
import numpy as np
import subprocess

# Conexión a la base de datos MySQL
conn = pymysql.connect(
    host="localhost",
    user="ana",
    password="ana",
    database="itinerarIA"
)

cursor = conn.cursor()

app = FastAPI(title="Logistics API")

# Configurar CORS
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Incluir rutas
app.include_router(router, prefix="/api/v1")

# Función para ejecutar el script y esperar a que termine antes de responder
@app.get("/optimize")
async def run_script():
    try:
        print("Ejecutando el llenado de camiones...")

        # Ejecutar el script en un proceso independiente de manera síncrona
        result_llenado = subprocess.run(["python", "llenadocamiones.py"], check=True, capture_output=True, text=True)

        # Mostrar el resultado en la consola
        print("Resultado del llenado de camiones:")
        print(result_llenado.stdout)

        print("#"*100)

        print("Ejecutando el calculo de rutas...")

        # Ejecutar el script en un proceso independiente de manera síncrona
        result_rutas = subprocess.run(["python", "calculoruta.py"], check=True, capture_output=True, text=True)

        # Mostrar el resultado en la consola
        print("Resultado de calculo de rutas:")
        print(result_rutas.stdout)

        return {"message": "Script ejecutado correctamente"}

    except subprocess.CalledProcessError as e:
        print(f"Error al ejecutar el script: {e.stderr}")
        return {"message": "Error al ejecutar el script", "error": e.stderr}

@app.get("/")
async def root():
    return {"message": "Welcome to the Logistics API"}
