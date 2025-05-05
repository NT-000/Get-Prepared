import fastapi
app = fastapi.FastAPI()
@app.get("/convert/hex-to-rgb")
def convert_hex_to_rgb(hex: str):

    r = int(hex[0:2], 16)
    g = int(hex[2:4], 16)
    b = int(hex[4:6], 16)
    return {"r": r, "g": g, "b": b}
