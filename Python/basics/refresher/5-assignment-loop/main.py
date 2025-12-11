"""
Given: my_list = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]

- Create a while loop that prints all elements of the my_list variable 3 times.

- When printing the elements, use a for loop to print the elements

- However, if the element of the for loop is equal to Monday, continue without printing
"""

my_list = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"]
new_list = []

counter = 0

while counter < 3:
	for i in my_list:
		if i == 'Monday':
			continue
		else:
			new_list.append(i)
	counter += 1

print(new_list)
print(len(new_list))
