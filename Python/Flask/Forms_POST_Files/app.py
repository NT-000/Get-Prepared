from flask import Flask, render_template, request, jsonify
app = Flask(__name__ , template_folder='templates')

@app.route('/', methods=['GET','POST'])
def index():
    if request.method == 'GET':
        return render_template('index.html')
    elif request.method == 'POST':
        username = request.form['username']
        password = request.form['password']

        if username == 'admin' and password == '123':
            return "Login Successful"
        else:
            return "Login Failed"
@app.route('/upload', methods=['POST'])
def upload():
    if request.method == 'POST':
        file = request.files['file']
        return "File Uploaded Successfully"
    else:
        return "File upload failed!"

@app.route('/handle_post', methods=['POST'])
def handle_post():
    if request.method == 'POST':
        greet = request.json['greeting']
        name = request.json['name']
        with open('greetings.txt', 'a') as f:
            f.write(f"{greet} {name}\n")
        return {'message': 'Successfully written'}

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5500, debug=True)