correct_answer = 1994

answer = int(input('When was Python 1.0 released? '))

while answer != correct_answer:
	if answer > correct_answer:
		print('It was earlier than that!')
	else:
		print('It was later than that!')

	answer = int(input('When was Python 1.0 released? '))

print('Correct!')