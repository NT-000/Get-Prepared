#immutable, does not support assignments
#BUT tuples can contain mutable elements like lists
import random

data = []

user_data = ('Joe', 'American', 1963, ['Norway', 'England'])
user_data2 = ('Henry', 'Canadian', 1963)

user_data[3].append('Brazil')
print(f"{user_data[0]} has visited countries {', ' .join(user_data[3])}")

random_number = random.randint(0, 1)

if random_number == 0:
	data = user_data
else:
	data = user_data2

if 'American' in data:
	print(f"User, {data[0]} is American")
else:
	print(f"User, {data[0]} is not American")


capitals = [('London', 'England'), ('Oslo', 'Norway'), ('Paris', 'France')]

for capitial in capitals:
	print('Capitial:',capitial[0], 'in:', capitial[1])

