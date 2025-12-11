

def calculate_grades(homework_grades_arg):
	sum_of_grades = sum(homework_grades_arg.values())
	final_grade = round(sum_of_grades / len(homework_grades_arg), 2)
	print(final_grade)