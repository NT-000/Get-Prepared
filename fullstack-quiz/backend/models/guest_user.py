from flask_login import UserMixin


class GuestUser(UserMixin):
	def __init__(self, id, username = None, name = "Gjest"):
		self.id = id
		self.username = username or id
		self.name = name + f"_{id}"
