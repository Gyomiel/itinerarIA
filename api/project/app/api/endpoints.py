from fastapi import APIRouter, HTTPException
import logging
from ..services.truck_loading_service import optimize_truck_loading
from ..services.route_optimization_service import optimize_routes

logger = logging.getLogger(__name__)
router = APIRouter(prefix="/optimization", tags=["optimization"])

@router.post("/load-trucks")
async def optimize_loading():
    """
    Optimiza la carga de los camiones usando clustering y algoritmos genéticos
    """
    try:
        logger.info("Iniciando optimización de carga de camiones")
        result = optimize_truck_loading()
        logger.info("Optimización de carga completada exitosamente")
        return {
            "status": "success",
            "data": result
        }
    except Exception as e:
        logger.error(f"Error en optimización de carga: {str(e)}", exc_info=True)
        raise HTTPException(status_code=500, detail=str(e))

@router.post("/optimize-routes")
async def optimize_route_sequence():
    """
    Optimiza las rutas para los camiones ya cargados
    """
    try:
        logger.info("Iniciando optimización de rutas")
        result = optimize_routes()
        logger.info("Optimización de rutas completada exitosamente")
        return {
            "status": "success",
            "data": result
        }
    except Exception as e:
        logger.error(f"Error en optimización de rutas: {str(e)}", exc_info=True)
        raise HTTPException(status_code=500, detail=str(e))