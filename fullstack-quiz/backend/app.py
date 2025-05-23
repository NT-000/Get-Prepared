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

#Login

@app.route("/api/login", methods=["POST"])
def login():
	data = request.get_json()
	username = data.get("username")
	password = data.get("password")

	user_data = users_coll.find_one({"username": username})

	if not user_data or user_data["password"] != password:
		return jsonify({"success": False, "message": "Invalid credentials"}), 401

	user = User(str(user_data["_id"]), user_data["username"], user_data["password"])
	print("logged in user:", user)
	login_user(user)
	return jsonify({"success": True, "message": "Login successful"}), 200


@app.route("/api/logged_in_user", methods=["POST"])
def logged_in_user():
	if current_user.is_authenticated:
		return jsonify({
			"success": True,
			"id": current_user.id,
			"username": current_user.username
		}), 200
	else:
		return jsonify({"success": False, "id": None}), 200

@app.route("/api/logged_in_guest", methods=["POST"])
def logged_in_guest():
	guest_id = f"guest{random.randint(1, 10000)}"
	guest = GuestUser(guest_id)
	print("logged in guestuser:", guest_id)
	login_user(guest)
	return jsonify({"success": True, "id": guest.id, "username": guest.username}), 200

#Logout
@app.route("/api/logout", methods=["POST"])
def logout():
	logout_user()
	return jsonify({"message": "logout successful"}), 200

@login_manager.user_loader
def load_user(user_id):
	if user_id.startswith("guest"):
		return GuestUser(id=user_id)
	else:
		return User.get(user_id)
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
def get_questions():
	docs = list(questions_coll.find({}, {"_id": False}))
	return jsonify(docs), 200

@app.route("/api/add-question", methods=["POST"])
def add_question():
	pass


#Scores
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

if __name__ == "__main__":
	app.run(host="0.0.0.0", port=5000,debug=True)