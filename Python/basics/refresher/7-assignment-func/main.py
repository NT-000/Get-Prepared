"""
- Create a function that takes in 3 parameters(firstname, lastname, age) and

returns a dictionary based on those values
"""

input_firstname = input("Enter first name: ")
input_lastname = input("Enter last name: ")
input_age = int(input("Enter age: "))

def create_dict(firstname, lastname, age):
	return {
		"firstname": firstname,
		"lastname": lastname,
		"age": age,
	}

print(create_dict(input_firstname, input_lastname, input_age))