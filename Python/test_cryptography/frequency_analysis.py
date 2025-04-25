import fastapi

app = fastapi.FastAPI()

@app.get("/cipher")
def vigenere_encrypt(text: str, key: str):
    result = []
    key_index = 0
    for char in text:
        if char.isalpha():
            shift = ord(key[key_index % len(key)].lower()) - ord('a')
            shift_base = ord('A') if char.isupper() else ord('a')
            result.append(chr((ord(char) - shift_base + shift) % 26 + shift_base))
            key_index += 1
        else:
            result.append(char)
    return {"ciphered_text": ''.join(result)}

@app.get("/decipher")
def vigenere_decrypt(ciphered_text: str, key: str):
    result = []
    key_index = 0
    for char in ciphered_text:
        if char.isalpha():
            shift = ord(key[key_index % len(key)].lower()) - ord('a')
            shift_base = ord('A') if char.isupper() else ord('a')
            result.append(chr((ord(char) - shift_base - shift + 26) % 26 + shift_base))
            key_index += 1
        else:
            result.append(char)
    return {"deciphered_text": ''.join(result)}

