animal_list = ['Dog', 'Chicken', 'Cat', 'Rat', 'Snake']

animal_list.remove(animal_list[3])
print('Removed element with index 3',animal_list)

animal_list.append('Rhino')
print('After added new element to the list:',animal_list)

animal_list.remove(animal_list[0])
print('After animal removed from index 0:',animal_list)

print('First three animals from list:',animal_list[0:3])