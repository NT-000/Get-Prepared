
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

for city_index in range(len(city_list)):
	print('Index:', city_index ,'| City:',city_list[city_index])


bills = [33.67, 55.68, 21, 23.12, 22, 33.78]
sum = 0.0
for bill in bills:
	sum += bill
	print('New bill:', '+' ,bill)
print('All your bills in total:',sum)

#swap places of elements

print('City list before swapping:', city_list)

city_list[0], city_list[1], city_list[2] = city_list[2], city_list[0], city_list[1]

print('City list after swapping:',city_list)

city_list.sort() #method that change the original list
print('City list after sorting:', city_list)

city_list.sort(reverse=True)
print('City list after reversing:', city_list)

print('City list sorted copy:', sorted(city_list)) #function that copies the original without changing the original list
print('Original city list:', city_list)

orig_list = [1, 2, 3]
new_list = orig_list # references/points to same list
print('Original list:', orig_list)
print('New list:', new_list)
del new_list[1:2]
print('New list:', new_list)
print('Original city list:', orig_list)

