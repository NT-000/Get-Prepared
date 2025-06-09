import os
from flask import Flask, jsonify, request
from flask_cors import CORS
from dotenv import load_dotenv
from flask_login import (LoginManager, login_user, login_required, logout_user, current_user)
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


# Login

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
def login_guest():
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


# Logout
@app.route("/api/logout", methods=["POST"])
@login_required
def logout():
	logout_user()
	print("logout user:", logout_user())
	print("current user:", current_user)
	return jsonify({"message": "logout successful"}), 200


# Users

@app.route("/api/users", methods=["POST"])
def create_user():
	data = request.get_json()
	print("data received, new user:", data)

	try:
		users_coll.insert_one(data)
		return jsonify({
			"success": True,
		}), 200
	except Exception as e:
		print("failed:", e)
		return jsonify({"success": False}), 400


@app.route("/api/users", methods=["GET"])
def get_users():
	docs = list(users_coll.find({}, {"_id": False}))
	return jsonify(docs), 200


@app.route("/api/check_user", methods=["GET"])
def check_user():
	username = request.args.get("username")

	if not username:
		return jsonify({'success': False, 'message': 'Username required'}), 400

	user_exists = users_coll.find_one({"username": username}) is not None

	print("user_exists:", user_exists)
	print("username:", username)
	return jsonify({'success': True, "exists": user_exists}), 200


# Questions

@app.route("/api/questions/<collection>", methods=["GET"])
def get_collection(collection):
	docs = list(db[collection].find({}, {"_id": False}))
	return jsonify(docs), 200


# Uses POST instead of GET because of the possible length of data
@app.route('/api/questions/filtered', methods=["POST"])
def filtered_questions():
	data = request.get_json()
	categories = data.get("categories", [])
	difficulty = data.get("difficulty", None)
	query = {}

	if categories:
		query["category"] = {"$in": categories}
	if difficulty:
		query["difficulty"] = difficulty
	print("query:", query)

	try:
		questions = list(questions_coll.find(query, {"_id": False}))
		return jsonify(questions), 200
	except Exception as e:
		print("failed:", e)
		return jsonify({"success": False, "message": str(e)}), 400


@app.route("/api/questions", methods=["GET"])
def get_questions():
	docs = list(questions_coll.find({}, {"_id": False}))
	return jsonify(docs), 200


# Scores
@app.route("/api/scores", methods=["GET"])
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
	app.run(host="0.0.0.0", port=5000, debug=True)
