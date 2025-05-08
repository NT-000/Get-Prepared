from flask import Flask, request

app = Flask(__name__)
@app.route('/')
def home():
    return "Home Page <h1>Hello World</h1>"

@app.route('/hello', methods=['GET', 'POST'])
def hello():
    if request.method == 'POST':
        return "Hello POST"
    else:
        return "Hello GET"

@app.route('/greet/<name>')
def user(name: str):
    return f"{name}"
@app.route('/add/<int:num1>/<int:num2>')
def addition(num1,num2):
    return f"{num1} + {num2} = {num1+num2}"

@app.route('/handle_url_params')
def handle_url_params():
    greet = request.args.get('greet')
    name = request.args.get('name')
    return f"{greet} {name}"

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
