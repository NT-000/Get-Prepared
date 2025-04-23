

choices = ['1.The Liquor Store', '2.The Circus']
print(f"Where would you like to go? {choices[0]} or {choices[1]}?")
choice = int(input())


price = 100

if choice == 1:
    real_age = int(input("What's your real age?(Just for you)"))
    print("Welcome to the Liquor Store, are you old enough to buy liquor?")
    age = int(input("Enter your age:"))
    has_id = False
    print(f"I am {age} years old, mr")

    if age == 0:
        print(f"{age} years old!? You are but an infant, no spirits for you.")
    elif age < 18:
        print(f"{age} years!? You are not even old enough to buy beer.")
    elif age >= 18 and age < 21:
        print(
            f"{age} years, you say? Then you can buy some beers instead, 21 years is the age limit for buying liquor.")
        has_id = True
        print("Do you have an ID?")
        if has_id and real_age == age:
            print(f"Your ID looks fine, it says you are {real_age}")
        else:
            print("No ID? No beer.")

    else:
        print(f"{age} years old? The liquor is yours, mr!")

else:
    has_ticket = False
    real_age = int(input("What's your real age?(Just for you)"))
    print("Clerk: Welcome to the circus!, what's your age?")
    age = int(input("Enter your age:"))
    if age < 18 and real_age == age:
        print(f"{age}, then you have to pay {price * 0.5} kr for a child-ticket")
        has_ticket = True
    elif age > 18 and age < 67 and real_age == age:
        print(f"{age}, then you have to pay {price} kr for an adult-ticket")
        has_ticket = True
    elif age >= 67 and real_age == age:
        print(f"{age}, then your have to pay {price * 0.7} kr for a senior-ticket")
        has_ticket = True
    else:
        print(f"Your age is not {age}, you are {real_age} years old according to your ID-papers")

    if has_ticket:
        print("Let me see your ticket")
        print("Thank you, enjoy the show!")
    else:
        print("No ticket? Get out of here.")