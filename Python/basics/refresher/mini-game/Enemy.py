import random

quotes = ['Coming for your ear!', 'Everyone has a plan ... ', 'I was gonna rip his heart out.']

class Enemy:
	type_of_enemy : str
	health: int
	attack: int
	strength: int

	def __init__(self, type_of_enemy):
		self.type_of_enemy = type_of_enemy
		self.health = random.randint(50, 100)
		self.attack = random.randint(7, 11)
		self.strength = random.randint(7, 11)

	def attack_enemy(self):
		damage = self.strength * self.attack/5
		return damage
	def low_health(self):
		print(f"{random.choice(quotes)}")
