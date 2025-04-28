import fastapi
from math import sqrt
app = fastapi.FastAPI()

@app.get("/")
async def root():
    return {"message": "Hello World"}

#optimization of the Fibonacci sequence, finding number in range
@app.get("/fibonacci/{number}")
async def fibonacci(number: int):
    a = 0
    b = 1
    fibonacci_number = []

    if number < 0:
        return

    elif number == 0:
        return 0

    elif number == 1:
        return b

    for i in range(1,number):
        c = a + b
        a = b
        b = c
        fibonacci_number.append(c)
    return {f"{number} fibonacci numbers": fibonacci_number}

@app.get("/fibonacci/find_closest/{num}")
async def find_closest_fibonacci(num: int):
    is_fibonacci = False

    # check to see if the number is already a fibonacci-number
    if sqrt(5 * num ** 2 + 4) % 1 == 0 or sqrt(5 * num ** 2 - 4) % 1 == 0:
        is_fibonacci = True
        closest_fib = num
    else:
        c = 0
        while True:
            c += 1
            # is num + c a Fibonacci-num
            if sqrt(5 * (num + c) ** 2 + 4) % 1 == 0 or sqrt(5 * (num + c) ** 2 - 4) % 1 == 0:
                closest_fib = num + c
                break

            # is num - c a Fibonacci-num
            if sqrt(5 * (num - c) ** 2 + 4) % 1 == 0 or sqrt(5 * (num - c) ** 2 - 4) % 1 == 0:
                closest_fib = num - c
                break

    return {
        "is_fibonacci": is_fibonacci,
        "closest_fibonacci_number": closest_fib
    }

