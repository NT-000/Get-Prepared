

english_to_norwegian = \
	{
		'dog': 'hund',
		'cat': 'katt',
		'rhino': 'nesehorn',
		'bird': 'fugl'
	}

search = input('Search for animals in english and translate them to norwegian')
found =  False
for key, value in english_to_norwegian.items():
	if search in key:
		print(f"{key} -> {value}")
		found = True
		break
if not found:
	print('Sorry, couldn\'t find that')
