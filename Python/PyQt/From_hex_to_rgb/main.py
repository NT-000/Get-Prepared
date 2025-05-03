import fastapi
from pydantic import BaseModel

app = fastapi.FastAPI()

class RGBColor(BaseModel):
    r: int
    g: int
    b: int
@app.get("/")
async def root():
    return {"message": "This is an api for converting hex to rgb"}

@app.get("/convert/hex-to-rgb")
async def convert_hex_to_rgb(hex: str):


    r = int(hex[0:2], 16)
    g = int(hex[2:4], 16)
    b = int(hex[4:6], 16)
    return {"r": r, "g": g, "b": b}