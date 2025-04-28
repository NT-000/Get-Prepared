
import requests

# Find x fibonacci numbers
def get_fibonacci_numbers():
    num = int(input("Enter how many fibonacci numbers to find: "))
    response = requests.get(f'http://127.0.0.1:8000/fibonacci/{num}')
    print(response.json())


# Finds the closest fibonacci-number
def find_closest_fibonacci():
    num = int(input("Enter a number to check closest fibonacci-number: "))
    response = requests.get(f'http://127.0.0.1:8000/fibonacci/find_closest/{num}')
    result = response.json()
    print(result.get("closest_fibonacci_number"))


if __name__ == "__main__":
    get_fibonacci_numbers()
    print("\n")
    find_closest_fibonacci()
