# #Helping with the Budget
# John has a hard time keeping his budget. Write a program to help him analyse his spendings. You are given a list with John's spendings for each month. Go through the list, and count the number of times...
#
# a. the spendings were low (< 1000.0)
# b. the spendings were normal (between 1000.0 and 2500.0 inclusive)
# c. the spendings were high (> 2500.0)
#
# Then, print the following to the output:
#
# Numbers of months with low spendings: x, normal spendings: y, high spendings: z.
#
# Replace x, y and z with the calculated numbers.

spendings = [1346.0, 987.50, 1734.40, 2567.0, 3271.45, 2500.0, 2130.0, 2510.30, 2987.34, 3120.50, 4069.78, 1000.0]

under_1000 = 0
between_1000_2500 = 0
over_2500 = 0

for expense in spendings:
	if expense < 1000:
		under_1000 += 1
	elif expense >= 1000 and expense <= 2500:
		between_1000_2500 += 1
	else:
		over_2500 += 1

print(
	f"Numbers of months with low spendings: {under_1000}, normal spendings: {between_1000_2500}, high spendings: {over_2500}.")