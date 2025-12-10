#iterative
def get_factorial(number):
	factorial = 1
	for x in range(1, number + 1):
		factorial *= x
	return factorial

print(get_factorial(2))

#recursion
def get_factorial_recursive(number):
	if number <= 1:
		return 1
	return number * get_factorial_recursive(number - 1)

print(get_factorial_recursive(6))