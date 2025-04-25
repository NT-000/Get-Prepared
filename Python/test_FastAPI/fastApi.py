import fastapi
import random

app = fastapi.FastAPI()


@app.get("/")
async def root():
    return {"message": "Hello World", "data": 12}


@app.get("/random")
async def get_random_default():
    rn = random.randint(1, 150)
    return {"number": rn, "limit": 150}


@app.get("/random/{limit}")
async def get_random_with_limit(limit: int):
    print("random limit runs")
    rn = random.randint(1, limit)
    return {"number": rn, "limit": limit}
