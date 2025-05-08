from flask import Flask, render_template, redirect, url_for
app = Flask(__name__, template_folder='templates')

@app.template_filter( 'reverse_string')
def reverse_string(s):
    return s[::-1]

@app.template_filter( 'repeat')
def repeat(s, times=2):
    return s * times

@app.template_filter( 'swap_case')
def swap_case(s):
    return s.swapcase()

@app.template_filter( 'alternate_case')
def alternate_case(s):
    return ''.join([c.upper() if i % 2 == 0 else c.lower() for i, c in enumerate(s)])


@app.route('/')
def home():
    name = "Nico"
    math = 2 * 10
    list = [1,2,3,4,5]
    return render_template('index.html', name=name, math=math, list=list)

@app.route('/other')
def other():
    text = "Hi, there!"
    return render_template('other.html', text=text)

@app.route('/redirect_endpoint')
def redirect_endpoint():
    return redirect(url_for('other'))

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)