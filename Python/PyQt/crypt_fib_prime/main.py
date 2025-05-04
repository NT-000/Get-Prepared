import fastapi
from collections import Counter
import requests

app = fastapi.FastAPI()

"""english_frequencies = {
    'A': 0.082, 'B': 0.015, 'C': 0.028, 'D': 0.043, 'E': 0.127, 'F': 0.022,
    'G': 0.020, 'H': 0.061, 'I': 0.070, 'J': 0.002, 'K': 0.008, 'L': 0.040,
    'M': 0.024, 'N': 0.067, 'O': 0.075, 'P': 0.019, 'Q': 0.001, 'R': 0.060,
    'S': 0.063, 'T': 0.091, 'U': 0.028, 'V': 0.010, 'W': 0.023, 'X': 0.001,
    'Y': 0.020, 'Z': 0.001
}"""


@app.get("/cipher")
def vigenere_encrypt(text: str, key: str):
    key = key.lower()
    key_length = len(key)
    result = []
    key_index_position = 0

    for char in text:
        if char.isalpha():
            key_letter = key[key_index_position % key_length]
            shift = ord(key_letter) - ord('a')
            shift_base = ord('A') if char.isupper() else ord('a')
            encrypted_position = (ord(char) - shift_base + shift) % 26 # converts the char to pos(0-25), adds shift, converts back again
            encrypted_char = chr(encrypted_position + shift_base)
            result.append(encrypted_char)
            key_index_position += 1
        else:
            result.append(char)  # stores characters that's not letters

    return {"ciphered_text": ''.join(result)}

@app.get("/decipher")
def vigenere_decrypt(ciphered_text: str, key: str):

    key = key.lower()
    key_length = len(key)
    result = []
    key_index_position = 0

    for char in ciphered_text:
        if char.isalpha():
            key_letter = key[key_index_position % key_length]
            shift = ord(key_letter) - ord('a')
            shift_base = ord('A') if char.isupper() else ord('a') # keep capitalization/small letters from the original text
            original_position = (ord(char) - shift_base - shift + 26) % 26 # converts the char to pos(0-25), subtracts the shift and converts back - always a positive num
            decrypted_char = chr(original_position + shift_base)
            result.append(decrypted_char)
            key_index_position += 1
        else:
            result.append(char) # stores characters that's not letters

    return {"deciphered_text": ''.join(result)}

@app.get("/crack")
def crack_vigenere_cipher(ciphered_text: str):

        # clean text for analyzing - keeps letters
        cleaned_text = ''.join([c for c in ciphered_text.upper() if c.isalpha()])

        if len(cleaned_text) < 20:
            return {
                "error": " Trenger minst 20 bokstaver."
            }

        # find probable key_length
        key_length = find_key_length(cleaned_text)

        # find
        key = find_key(cleaned_text, key_length)

        res = requests.get(
            f"http://127.0.0.1:8000/decipher?ciphered_text={ciphered_text}&key={key.lower()}",
            timeout=5
        )
        decrypted = res.json()["deciphered_text"]

        return {
            "suggested_key": key.lower(),  # Tilpass til formatet brukt i frontend
            "key_length": key_length,
            "deciphered_text": decrypted
        }

@app.get("/primes/closest/{number}")
async def get_closest_prime(number: int):
    #generates numbers close to input number, have set an interval og 100, but can
    upper_limit = number + 100
    primes = []
    numbers = [True] * (upper_limit + 1)
    for i in range(2, upper_limit + 1):
        if numbers[i]:
            primes.append(i)
            for j in range(i * i, upper_limit + 1, i):
                numbers[j] = False

    # find closest primenumber
    min_distance = float('inf') #to be sure that min_distance is lesser than input
    closest_prime = None

    for p in primes:
        distance = abs(number - p)
        if distance < min_distance:
            min_distance = distance
            closest_prime = p

    return {
        "closest_prime": closest_prime,
        "distance": min_distance
    }

@app.get("/fibonacci/find_closest/{num}")
async def find_closest_fibonacci(num: int):
    # generate Fibonacci numbers up to a reasonable limit
    fibonacci_numbers = [0, 1]
    while fibonacci_numbers[-1] < max(num * 2, 1000):  # Generate enough numbers
        fibonacci_numbers.append(fibonacci_numbers[-1] + fibonacci_numbers[-2])

    if num in fibonacci_numbers:
        return {
            "is_fibonacci": True,
            "closest_fibonacci_number": num
        }

    def calculate_distance(x):
        return abs(x - num)
    # closest fib number, calculates distance to fib num abs always returns a positive number
    closest_fib = min(fibonacci_numbers, key=calculate_distance)

    return {
        "is_fibonacci": False,
        "closest_fibonacci_number": closest_fib
    }


def index_of_coincidence(text):
    #calculates coincidence of a text
    counts = Counter(text)
    total = len(text)

    if total <= 1:
        return 0

    ioc = 0
    for count in counts.values():
        ioc += count * (count - 1)

    ioc /= total * (total - 1)
    return ioc


def find_key_length(ciphertext, max_length=20):

    #finds the likely key length for a Vigenère-encrypted text
    #using Index of Coincidence (IoC).

    results = [] # stores a tuple(test_length, average_length)

    # key lengths from 1 to max_length (or half of text-length)
    max_potential_length = min(max_length, len(ciphertext) // 2)

    for test_length in range(1, max_potential_length + 1):
        # for each potential key length, create test_length number of groups
        groups = []

        # create groups by taking every test_length-th character

        for start_pos in range(test_length):

            # create a group with characters that share the same position in the key cycle
            group = ""
            pos = start_pos
            while pos < len(ciphertext): # each character will be encrypted with the same char in the key, example if the key consist of 5 characters, each fifth char in the ciphertext will be encrypted with the same letter. If the key has a length of 5 it gets 5 different groups.
                group += ciphertext[pos]
                pos += test_length

            groups.append(group)

        # calculate average IoC for all groups
        total_ioc = 0
        for group in groups:
            total_ioc += index_of_coincidence(group)

        average_ioc = total_ioc / test_length

        # store result for this key length
        results.append((test_length, average_ioc))

    # sort results based on how close the IoC value is to 0.067.
    # the closer to 0.067, the more likely it is the correct key length

    def sort_by_distance_to_target(x):
        target_value = 0.067
        return abs(x[1] - target_value)

    results.sort(key=sort_by_distance_to_target)

    # return the length with IoC value closest to 0.067
    return results[0][0]


def find_shift(sequence):
    best_shift = 0
    best_score = 0

    # most used letters in english grammar, descending from ETA...
    common_letters = "ETAOINSRHDLUCMFYWGPBVKJXQZ"

    for shift in range(26):
        # decrypt with this shift
        decrypted_text= ""
        for letter in sequence:
            position = ord(letter) - ord('A') # converts letter to position
            new_pos = (position - shift) % 26 #decrypts by subtracting the shift

            decrypted_letter = chr(new_pos + ord('A')) ## converts back to letter
            decrypted_text += decrypted_letter

        score = 0
        for letter in decrypted_text:
            letter_position = common_letters.find(letter) # position in common-letters

            if letter_position != -1:
                letter_value = 26 - letter_position # higher value based on position in common_letters, the most common used letters in the english language - 26 points for E, 25 T and so on.
                score += letter_value

        if score > best_score:
            best_score = score
            best_shift = shift

    return best_shift

    # finds key based on probable key-length
def find_key(ciphertext, key_length):
    key = ""

    for character in range(key_length):

        sequence = []
        c = character

        while c < len(ciphertext):
            sequence.append(ciphertext[c])
            c += key_length

        # the most probable shift, by analyzing frequency of letters in sequence and returns the most probable shift
        best_shift = find_shift(sequence)

        # ASCII-value of a(65), base, + shift-value, converts back to letter
        key_letter = chr(best_shift + ord('A'))
        key += key_letter

    return key


