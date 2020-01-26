from flask import Flask, session, redirect, render_template, request
from flask_session.__init__ import Session
from hashlib import md5
from Crypto import Random
from Crypto.Cipher import AES
from random import randint
import codecs
import secret_key

app = Flask(__name__)
app.secret_key = secret_key.key_calc()
app.config['SESSION_TYPE'] = 'filesystem'
app.config.from_object(__name__)
Session(app)

BLOCK_SIZE = 16 
pad = lambda s: s.decode("utf-8") + (BLOCK_SIZE - len(s) % BLOCK_SIZE) * chr(BLOCK_SIZE - len(s) % BLOCK_SIZE)
unpad = lambda s: s[:-ord(s[len(s) - 1:])]

class AESCipher:
    def __init__(self, key):
        self.key = md5(key.encode('utf8')).hexdigest()

    def encrypt(self, raw):
        raw = pad(raw)
        iv = Random.new().read(AES.block_size)
        cipher = AES.new(self.key.encode("utf-8"), AES.MODE_CBC, iv)
        return codecs.encode(iv + cipher.encrypt(raw.encode("utf-8")), 'hex_codec')

    def decrypt(self, enc):
        enc = codecs.decode(enc,'hex_codec')
        iv = enc[:16]
        cipher = AES.new(self.key.encode("utf-8"), AES.MODE_CBC, iv)
        return unpad(cipher.decrypt(enc[16:]))

def gen_lott_check(number):
	return True if (0 <= int(number) <= 50) else False

def get_length(balance):
	count=0
	for i in balance:
		try:
			int(i)
			count+=1
		except:
			break
	return count

def check_bet(bet):
	length_bet = get_length(bet)
	length_balance = get_length(session['current_money'])
	if (length_bet > length_balance):
		return False
	if (length_bet == length_balance):
		for i in range(0,length_balance):
				if int(str(session['current_money'])[i]) < int(bet[i]):
					return False
	return True

@app.errorhandler(404)
def page_not_found(e):
    return render_template("error.html")

@app.errorhandler(500)
def internal_error(e):
    return render_template("error.html")

@app.route('/', methods=['GET','POST'])
def hello_world():
	tsu = None
	flower = None
	source = None
	flag = None
	content = None
	if(session.get('isset') == 1):
		if session['flower'] == 1:
			flower = 'Flower'
			if request.method == 'POST' and request.form['take']=='flower':
				content = "Flower can be seen as a girl, beautiful girl ^.^!"
		if session['tsu'] == 1:
			tsu = 'Tsug0d'
			if request.method == 'POST' and request.form['take']=='tsu':
				content = "Tsu? just the author of this challenge ^_^!"
		if session['source'] == 1:
			source = 'Source'
			if request.method == 'POST' and request.form['take']=='source':
				content = open("main.py").read()
		if session['flag'] == 1:
			flag = '=Flag='
			if request.method == 'POST' and request.form['take']=='flag':
				content = open("fl4gggg.txt").read()
	else:
		session['isset'] = 1
		session['current_money'] = "1000"
		session['flower'] = 0
		session['tsu'] = 0
		session['flag'] = 0
		session['source'] = 0
	return render_template('index.html', money=session['current_money'], tsu = tsu, flower = flower, source = source, flag = flag, content = content)

@app.route('/lott', methods=['GET','POST'])
def lott():
	status = None
	stored_value={}
	jackpot = randint(0,50)
	if request.method == 'POST':
		if request.form['ticket']:
			ticket = AESCipher(app.secret_key).decrypt(request.form['ticket']).decode('utf-8')
			ticket = ticket.split(";")
			if (len(ticket)!=3):
				return redirect("/lott", code=302)
			for i in ticket:
				x = i.split('=')
				stored_value[x[0]]=x[1]
			if(str(stored_value['bet']).find("-")>0 or str(stored_value['bet']).find("+")>0):
				return render_template("error.html")
			if (check_bet(stored_value['bet'].strip()) and stored_value['number'].isnumeric()):
				status = "Jackpot: %s | Your guess: %s" % (jackpot, stored_value['number'])
				if (stored_value['number'] == str(jackpot)):
					session['current_money'] = str(int(session['current_money']) + int(stored_value['bet']))
				else:
					session['current_money'] = str(int(session['current_money']) - int(stored_value['bet']))
			else:
				status = "You bet $%s, but you only have $%s" % (str(stored_value['bet']), session['current_money'])
	return render_template('lott.html', money=session['current_money'], status = status)

@app.route('/market', methods=['GET','POST'])
def market():
	status=None
	if request.method == 'POST':
		if request.form['buy']:
			if request.form['buy']=='flower':
				if int(session['current_money'])>=500:
					session['current_money']=str(int(session['current_money'])-500)
					session['flower'] = 1
					status="Buy flower Successful!"
				else:
					status="Not enough money!"
			elif request.form['buy']=='tsu':
				if int(session['current_money'])>=500:
					session['current_money']=str(int(session['current_money'])-500)
					session['tsu'] = 1
					status="Buy tsu Successful!"
				else:
					status="Not enough money!"
			elif request.form['buy']=='source':
				if int(session['current_money'])>=2000:
					session['current_money']=str(int(session['current_money'])-2000)
					session['source'] = 1
					status="Buy source Successful!"
				else:
					status="Not enough money!"
			elif request.form['buy']=='flag':
				if int(session['current_money'])>=1337000000:
					session['current_money']=str(int(session['current_money'])-1337000000)
					session['flag'] = 1
					status="Buy flag Successful!"		
				else:
					status="Not enough money!"
			else:
				status="Item not available!"
	return render_template('market.html', money=session['current_money'], status=status)

@app.route('/ticket', methods=['GET','POST'])
def buy_ticket():
	status=None
	session_x = request.cookies.get('session')
	if request.method == 'POST':
		if request.form['number'] and request.form['bet']:
			number = request.form['number']
			bet = request.form['bet']
			if (gen_lott_check(number) and bet.isnumeric()):
				ticket = "number=%s;bet=%s;session=%s" %(number,bet,session_x)
				status = 'Here your ticket: %s' % AESCipher(app.secret_key).encrypt(bytes(ticket,"utf-8")).decode("utf-8") 
			else:
				status = "Something wrong"
	return render_template('ticket.html', money = session['current_money'], status = status)

@app.route('/reset')
def reset():
	session.clear()
	return redirect("/", code=302)


if __name__ == '__main__':
	app.run(host="0.0.0.0", port="7005")