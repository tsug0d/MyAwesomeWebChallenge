from flask import Flask
from flask import render_template
import random
app = Flask(__name__)

@app.route('/')
def index():
	rand = str(random.randint(1,5))
	return render_template('index.html', random=rand)

@app.route('/read/<path:filename>')
def read(filename=None):
	rand = str(random.randint(1,5))
	try:
		content = open(filename,'r').read()
	except:
		raise
	return render_template('file.html', filename=content, random=rand)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port='9005', debug=True)
