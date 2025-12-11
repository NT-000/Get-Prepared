import random

quotes = ['I will not give up!', 'The Real Deal never quits!', 'You can take my ear, but not my title!', 'I am a warrior!']

class Hero:
	name : str
	health : int
	attack : int
	strength : int

	def __init__(self, name):
		self.name = name
		self.health = random.randint(70, 130)
		self.attack = random.randint(6, 10)
		self.strength = random.randint(6, 10)

	def attack_enemy(self):
		damage = self.strength * self.attack/5
		return damage

	def low_health(self):
		print(f"{random.choice(quotes)}")


