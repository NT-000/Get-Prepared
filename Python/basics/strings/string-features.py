text = 'uppercase'
print(text.upper())

text_lowercase = 'lowercase'
print(text_lowercase.lower())

user_input = input('Enter a number: ')

while user_input.isnumeric() == False or user_input.isdigit() == False:
	if user_input.isalpha():
		print('You have entered a letter')
	elif user_input.isdigit():
		print('You have entered a number')
	elif user_input.isnumeric():
		print('You have entered a numeric number')
	elif user_input.isspace():
		print('You have entered a space')
	else:
		print('I don\'t know...')
	user_input = input('Enter a number: ')
print('You entered number', user_input)