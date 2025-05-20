from bson import ObjectId
from flask_login import UserMixin
from models.db import users_coll

class User(UserMixin):
    def __init__(self, id, username, password):
        self.id = id
        self.username = username
        self.password = password

    @staticmethod
    def get(user_id):

        try:
            object_id = ObjectId(user_id)

        except:
            return None

        data = users_coll.find_one({"_id": object_id})
        if data:
            return User(str(data["_id"]), data["username"], data["password"])
        return None

