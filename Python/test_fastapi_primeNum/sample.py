import requests

limit = int(input("Primenumbers up to which number?: "))
response = requests.get(f'http://127.0.0.1:8000/primes/{limit}')
print(response.json())

number = int(input("Check primefactors to number: "))
response = requests.get(f'http://127.0.0.1:8000/{number}')
print(response.json())

