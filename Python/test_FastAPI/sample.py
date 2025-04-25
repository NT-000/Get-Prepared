import requests

res = requests.get('http://127.0.0.1:8000')
print(res.json())

res = requests.get('http://127.0.0.1:8000/random')
print(res.json())

limit = int(input("Enter the limit: "))
res = requests.get(f'http://127.0.0.1:8000/random/{limit}')
print(res.json())