from Enemy import *
from Hero import *
import random

enemy_boxer = Enemy('Mike Tyson')
hero = Hero('Evander Holyfield')
counter = random.randint(1,2)

print(f"{enemy_boxer.type_of_enemy} stats:\nName: {enemy_boxer.type_of_enemy}\nHealth:{enemy_boxer.health}\nAttack:{enemy_boxer.attack}\nStrength: {enemy_boxer.strength}\n")

print(f"{hero.name} stats:\nName: {hero.name}\nHealth:{hero.health}\nAttack:{hero.attack}\nStrength: {hero.strength}\n")

while enemy_boxer.health > 0 and hero.health > 0:
		if enemy_boxer.health < 20:
			enemy_boxer.low_health()

		if hero.health < 20:
			hero.low_health()

		if counter == 1:
			damage = hero.attack_enemy()
			enemy_boxer.health -= damage
			print(f"{hero.name} attacks {enemy_boxer.type_of_enemy} for {damage}, {enemy_boxer.type_of_enemy} has {enemy_boxer.health} HP left")
			if enemy_boxer.health <= 0:
				print(f"{enemy_boxer.type_of_enemy} was KO'ed!")
			counter += 1
		elif counter == 2:
			damage = enemy_boxer.attack_enemy()
			hero.health -= damage
			print(f"{enemy_boxer.type_of_enemy} attacks {hero.name} for {damage}, {hero.name} has {hero.health} HP left")
			if hero.health <= 0:
				print(f"{hero.name} can't fight anymore, {enemy_boxer.type_of_enemy} took a chunk of his ear!")
			counter += 1
		elif counter > 2:
			counter = 1