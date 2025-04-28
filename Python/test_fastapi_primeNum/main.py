import fastapi

app = fastapi.FastAPI()

# Find primefactors to input number
@app.get("/{number}")
async def prime_numbers(number: int):
    original_num = number
    primes = []
    while number >= 2 and number % 2 == 0:
        primes.append(2)
        number //= 2
    i = 3
    while i * i <= number:
        while number % i == 0:
            primes.append(i)
            number //=i
        i += 2

    if number > 1:
        primes.append(number)

    return {"Primefactors": primes, "number": original_num}


# Find primenumbers up to input number using Eratosthenes Sieve
@app.get("/primes/{limit}")
async def get_primes(limit: int):
    x, y = 2, limit  # define the range

    primes = [True] * (y + 1)

    # 0 and 1 are not primenumbers
    primes[0], primes[1] = False, False

    # Sieve of Eratosthenes to mark numbers that's not primes
    for i in range(2, int(y ** 0.5) + 1):
        if primes[i]:
            for j in range(i * i, y + 1, i):
                primes[j] = False

    # collect primes in the range [x, y]
    res = [i for i in range(x, y + 1) if primes[i]]
    return {"Primes": res, "limit": limit}

@app.get("/primes/closest/{number}")
async def get_closest_prime(number: int):
    # generates numbers close to input number, have set an interval og 100, but can
    upper_limit = number + 100
    primes = []
    numbers = [True] * (upper_limit + 1)
    for i in range(2, upper_limit + 1):
        if numbers[i]:
            primes.append(i)
            for j in range(i * i, upper_limit + 1, i):
                numbers[j] = False

    # find closest primenumber
    max_distance = float('inf')
    closest_prime = None

    for p in primes:
        distance = abs(number - p)
        if distance < max_distance:
            max_distance = distance
            closest_prime = p

    return {
        "closest_prime": closest_prime,
        "distance": max_distance
    }
