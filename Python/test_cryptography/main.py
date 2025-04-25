import fastapi
from cryptography.fernet import Fernet

app = fastapi.FastAPI()

SECRET_KEY = Fernet.generate_key()
fernet = Fernet(SECRET_KEY)

@app.get("/")
async def root():
    return {"message": "This is an api for ciphering and deciphering text"}

@app.get("/cipher/{text}")
async def cipher(text: str):
    cipher_text = fernet.encrypt(text.encode())
    return {"cipher_text": cipher_text.decode()}

@app.get("/decipher/{encrypted_text}")
async def decipher(encrypted_text: str):
    decrypted_text = fernet.decrypt(encrypted_text.encode())
    return {"deciphered_text": decrypted_text.decode()}



