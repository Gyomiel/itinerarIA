from pydantic_settings import BaseSettings

class Settings(BaseSettings):
    API_KEY: str = "35ba8f2c-ecde-4176-bd17-203259ebebef"
    API_URL_OPTIMIZATION: str = "https://graphhopper.com/api/1/vrp"
    API_URL_ROUTE: str = "https://graphhopper.com/api/1/route"
    DB_HOST: str = "localhost"
    DB_USER: str = "root"
    DB_PASSWORD: str = "root"
    DB_DATABASE: str = "itinerarIA"
    WAREHOUSE_LAT: float = 27.96683841473653
    WAREHOUSE_LNG: float = -15.392203774815524
    N_CLUSTERS: int = 8

    class Config:
        env_file = ".env"

settings = Settings()