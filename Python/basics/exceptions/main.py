try:
	value = int(input('Enter a number: '))
	print('The inverse of:', value, 'is', 1/value)
except ValueError:
	print('You did not input a number')
except ZeroDivisionError:
	print('You can\'t divide by zero')
except:
	print('Something went wrong')

#exception propagation

user_info = []
print('Hi, fill out your birthday!')
def get_user_day():
	day = int(input('Enter a day: '))
	user_info.append(day)

def get_user_month():
	month = int(input('Enter a month: '))
	user_info.append(month)

def get_user_year():
	year = int(input('Enter a year: '))
	user_info.append(year)

def get_user_bday():
	try: # exceptions are propagated through functions
		get_user_day()
		get_user_month()
		get_user_year()
		print(f"Your were born:{user_info[0]}.{user_info[1]}.{user_info[2]}")
	except ValueError:
		print('Oh no, you entered incorrect data...')
get_user_bday()
