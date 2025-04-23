
print("1-10")
for i in range(1,11): #range = iterations
    print(i)

print("\n")
print("1-10 adds 2 every iteration")
for i in range(1,11,2): #adds 2 each iteration
    print(i)

name = "Joe Schmo"
for letter in name:
    print(letter, end=" ")

print("\n")

for letter in name:
    print(letter, end="-")
print("END")

is_ready = False
while not is_ready:
    for i in range(11, -1, -1):
        if i == 0:
            print("It's a new year!")
            is_ready = True
        else:
            print(i)


