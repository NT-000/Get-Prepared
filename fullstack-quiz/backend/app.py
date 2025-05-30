import os

from flask import Flask, jsonify, request
from flask_cors import CORS
from dotenv import load_dotenv
from flask_login import (LoginManager, login_user, login_required, logout_user, current_user, user_logged_in)

from backend.models.guest_user import GuestUser
from models.db import users_coll, db, scores_coll, questions_coll
from models.user import User
import random

load_dotenv()
SECRET_KEY = os.getenv("SECRET_KEY")

app = Flask(__name__)

app.secret_key = SECRET_KEY

CORS(app, resources={r"/api/*": {"origins": "http://localhost:5173"}}, supports_credentials=True)

login_manager = LoginManager()
login_manager.init_app(app)
login_manager.login_view = "login"

@login_manager.user_loader
def load_user(user_id):
	if user_id.startswith("guest"):
		return GuestUser(id=user_id)
	else:
		return User.get(user_id)

#Login

@app.route("/api/login", methods=["POST"])
def login():
	data = request.get_json()
	username = data.get("username")
	password = data.get("password")

	user_data = users_coll.find_one({"username": username})

	if not user_data or user_data["password"] != password:
		return jsonify({"success": False, "message": "Invalid credentials"}), 401

	user = User(str(user_data["_id"]), user_data["username"], user_data["password"], user_data["name"])
	print("logged in user:", user)
	login_user(user)
	print("current user, login guest:", current_user.id, current_user.name)
	return jsonify({"success": True, "message": "Login successful"}), 200


@app.route("/api/login_guest", methods=["POST"])
def logged_in_guest():
	guest_id = f"guest{random.randint(1, 10000)}"
	guest = GuestUser(guest_id)
	print("logged in guestuser:", guest_id)
	login_user(guest)
	print("current user, login guest:", current_user.username)
	print("login user:", login_user(guest))
	return jsonify({"success": True, "id": guest.id, "username": guest.username}), 200


@app.route("/api/logged_in_user", methods=["GET"])
def logged_in_user():
	if current_user.is_authenticated:
		return jsonify({
			"success": True,
			"id": current_user.id,
			"username": current_user.username,
			"name": current_user.name,
		}), 200
	else:
		return jsonify({"success": False, "id": None}), 200


#Logout
@app.route("/api/logout", methods=["POST"])
def logout():
	logout_user()
	print("logout user:", logout_user())
	print("current user:", current_user)
	return jsonify({"message": "logout successful"}), 200

#Users

@app.route("/api/users", methods=["POST"])
def create_user():
	pass

@app.route("/api/users", methods=["GET"])
def get_users():
	docs = list(users_coll.find({}, {"_id": False}))
	return jsonify(docs), 200

#Questions

@app.route("/api/questions/<collection>", methods=["GET"])
def get_collection(collection):
	docs = list(db[collection].find({}, {"_id": False}))
	return jsonify(docs), 200


@app.route("/api/questions", methods=["GET"])
@login_required
def get_questions():
	docs = list(questions_coll.find({}, {"_id": False}))
	return jsonify(docs), 200


#Scores
@app.route("/api/scores", methods=["GET"])
@login_required
def get_scores():
	docs = list(scores_coll.find({}, {"_id": False}))
	docs_sorted = sorted(docs, key=lambda doc: doc["score"], reverse=True)
	return jsonify(docs_sorted), 200

@app.route("/api/scores", methods=["POST"])
@login_required
def post_scores():
	data = request.get_json()
	print("Received data:", data)
	username = data.get("username")
	score = data.get("score")
	game_type = data.get("gameType")

	try:
		new_score_object = {"username": username, "score": score, "gameType": game_type}
		result = scores_coll.insert_one(new_score_object)
		inserted_id = str(result.inserted_id)
		print("inserted id:", inserted_id)
		return jsonify({"success": True, "inserted_id": inserted_id}), 200
	except Exception as e:
		print("failed:", e)
		return jsonify({"success": False}), 400


@app.route("/api/scores", methods=["DELETE"])
def delete_scores():
	pass

if __name__ == "__main__":
	app.run(host="0.0.0.0", port=5000,debug=True)