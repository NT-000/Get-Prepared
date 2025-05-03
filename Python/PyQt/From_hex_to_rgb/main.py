import fastapi

app = fastapi.FastAPI()

@app.get("/")
async def root():
    return {"message": "This is an api for converting hex to rgb"}