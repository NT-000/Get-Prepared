grades = {}

grades['Joey'] = 'C'
grades['Mary'] = 'D'

print(grades)
grades.update({'Joey': 'A', 'Mary': 'A'})
print('New grades:', grades)

print('Number of grades:',len(grades))

if 'Joey' in grades:
	print('Joey grade:', grades['Joey'])

for element in grades:
	print(element)

for element in grades.values():
	print(element)

for person, grade in grades.items():
	print(person,'-', grade)