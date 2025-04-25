import requests
import main

print(f"SecretKey: {main.SECRET_KEY}") # only for testing

response = requests.get('http://127.0.0.1:8000')
print(response.json())

print("Encrypt text")
text_to_encrypt = input("Enter the text to encrypt: ")
cipher_response = requests.get(f'http://127.0.0.1:8000/cipher/{text_to_encrypt}')
cipher_text = cipher_response.json().get("cipher_text")
print(f"Encrypted text: {cipher_text}")

print("\n")


print("Deciphering")
deciphered_response = requests.get(f'http://127.0.0.1:8000/decipher/{cipher_text}')
deciphered_text = deciphered_response.json().get('deciphered_text')
print("Deciphered text:",deciphered_text)
