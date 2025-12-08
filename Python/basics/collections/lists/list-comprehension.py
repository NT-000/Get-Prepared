numbers = []

for n in range(1, 101):
	numbers.append(n)
print(numbers)

numbers2 = [n for n in range(1, 101)]
print(numbers2)

print('\n List comprehension with modulus 2:\n')
numbers = [i for i in range(1, 101) if i % 2 == 0]
print(numbers)