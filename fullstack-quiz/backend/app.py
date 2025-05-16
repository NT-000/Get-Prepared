import os
from flask import Flask, jsonify, request
from flask_cors import CORS
from pymongo import MongoClient
from dotenv import load_dotenv

load_dotenv()
MONGODB_URI = os.getenv("MONGODB_URI")

app = Flask(__name__)
CORS(app, resources={r"/api/*": {"origins": "*"}})

client = MongoClient(MONGODB_URI)
db = client.get_database("quiz")
questions_coll = db["questions"]
scores_coll = db["scores"]


questions = client.quiz.questions

print(client.list_database_names())
print(client.quiz.list_collection_names())

@app.route("/api/questions", methods=["GET"])
def get_questions():
    docs = list(questions_coll.find({}, {"_id": False}))
    return jsonify(docs), 200

@app.route("/api/scores", methods=["GET"])
def get_scores():
    docs = list(scores_coll.find({}, {"_id": False}))
    return jsonify(docs), 200

@app.route("/api/scores", methods=["POST"])
def post_scores():
    pass

@app.route("/api/scores", methods=["DELETE"])
def delete_scores():
    pass

@app.route("/api/add-question", methods=["POST"])
def add_question():
    pass

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000,debug=True)