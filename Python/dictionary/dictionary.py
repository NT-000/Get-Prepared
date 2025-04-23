from operator import truediv

car = {"Brand": "Volvo", "Model": "XC90", "Year": 2023, "Color": "Blue"}

for key, value in car.items():
    print(key, ":", value)


text = "howdy partner, have a nice day!"
letter_counter = {}

for letter in text.lower():
    if letter.isalpha():
        if letter in letter_counter:
            letter_counter[letter] += 1
        else:
            letter_counter[letter] = 1

print(letter_counter)

players = [
    {"name":"Alessandro Del Piero", "Team": "Juventus"},
    {"name":"Alessandro Birindelli", "Team": "Juventus"},
    {"name":"Lillian Thuram", "Team": "Juventus"},
    {"name":"Pavel Nedved", "Team": "Juventus"},
    {"name":"Andrei Shevchenko", "Team": "AC Milan"},
    {"name":"Gennaro Gattuso", "Team": "AC Milan"},
    {"name":"Maldini", "Team": "AC Milan"},
    {"name":"Dida", "Team": "AC Milan"},
]

team_groups = {}

for player in players:
    team = player["Team"]
    if team not in team_groups:
        team_groups[team] = []
    team_groups[team].append(player["name"])

print(team_groups)

#Roman numbers to numbers converter

replay = True


def roman_to_num(roman):
    roman_num = {'I':1, 'V':5, 'X': 10, 'L': 50, 'C': 100, 'D': 500, 'M': 1000}
    num = 0
    for i in range(len(roman)):
        if i + 1 < len(roman) and roman_num[roman[i]] < roman_num[roman[i + 1]]:
            num -= roman_num[roman[i]]
        else:
            num += roman_num[roman[i]]
    return num


while replay:
    chosen_num = input("Input roman number and convert to regular number: ")
    print(roman_to_num(chosen_num))
    answer = input("Want to try again? y/n: ")
    if answer == "y":
        replay = True
    else:
        replay = False


#Number to Roman number converter

def roman_to_number(number):
    roman_num_map = {1000: 'M', 900: 'CM', 500: 'D', 400: 'CD', 100: 'C', 90: 'XC', 50: 'L', 40: 'XL', 10: 'X', 9: 'IX',
                     5: 'V', 4: 'IV', 1: 'I'}
    roman_num = ""

    for value, num in roman_num_map.items():
        while number >= value:
            roman_num += num
            number -= value
    return roman_num


number_to_convert = int(input("What to number do you want to convert to roman numbers?"))

print(roman_to_number(number_to_convert))
