table = [['A1', 'A2', 'A3'], ['B1', 'B2', 'B3'], ['C1', 'C2', 'C3']]

for cell in table:
	print('Element:',cell)


for row in table:
	for cell in row:
		print('Element:',cell)

print('\n Table:')
for row in table:
	for cell in row:
		print(cell, '', end='')
	print()

table2 = [[i for i in range(1,6)] for i in range(4)]
print(table2)
for row in table2:
	for cell in row:
		print(cell, '', end='')
	print()
