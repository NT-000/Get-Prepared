num_list = [1,2,3,4,5,6]
name_list = ["John", "Willy", "Chanel", "Cinnamon"]
mixed_list = [1, "Hello", 6, True]
empty_list = []
counter = 0

print(name_list[-1])

#Check frequency of letter in name from array.

for name in name_list:
    counter += 1
    print(counter,".",name)
chosen_index2 = int(input("Choose person to check frequency of letters"))
empty_list.append(chosen_index2-1)
letterToCheck = input("Which letter to check frequency in name?")
check = name_list[chosen_index2-1].count(str(letterToCheck.lower()))
print(f"Frequency of {letterToCheck}:{check}")
counter = 0


#Change name in array

for name in name_list:

    counter += 1
    print(counter,".",name)
chosen_index = int(input("Who do you want to change the name of?"))
new_name = input("Enter new name")
name_list[chosen_index-1] = new_name
print(name_list)


new_num = int(input("Add new number to array"))
num_list.append(new_num)
print(num_list)


name_list.sort()
print(name_list)