import os
from pymongo import MongoClient
from dotenv import load_dotenv

load_dotenv()
MONGODB_URI = os.getenv("MONGODB_URI")

client = MongoClient(MONGODB_URI)
db = client.get_database("quiz")
questions_coll = db["questions"]
scores_coll = db["scores"]
users_coll = db["users"]
time_coll = db["time"]
