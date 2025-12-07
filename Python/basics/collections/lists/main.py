
empty_list = []
city_list = ['Oslo', 'Moss', 'Bergen', 'Trondheim', 'Tromsø']

print(city_list[0:2]) # slice

print(city_list[2:]) # starts at index 0 and the rest of the list

print(city_list[:2]) # starts at index 0 and stops at index 2

del city_list[2] # deletes i2

print(city_list)

del city_list [3:] # deletes everything from index 3
print(city_list)

del city_list[:2] # deletes everything to index 2
print(city_list)

city_list.append('Ålesund') # add to list
print(city_list)

city_list.insert(0,'Kristansund') # insert value at index
print(city_list)