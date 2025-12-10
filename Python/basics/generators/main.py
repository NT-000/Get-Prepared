def get_number():
	for i in range(1,5):
		yield i

generator = get_number()
print(next(generator))
print(next(generator))
print(next(generator))
print(next(generator))
print(end='\n')

for x in get_number():
	print(x)

print('Build list with generator:')
numbers = list(get_number())
print(numbers)