from dotenv import load_dotenv
from kucoin.client import Client
import os, websocket, json, time, pprint

from datetime import datetime

# ______________________________________________________________________

project_folder = '/home/foxcodenine/Desktop/foxtraders_v1.0'


load_dotenv(os.path.join(project_folder, '.env'), override=True)

# ______________________________________________________________________

api_key = os.getenv('API_KEY')
api_secret = os.getenv('API_SECRET')
api_passphrase = os.getenv('API_PASSPHRASE')

client = Client(api_key, api_secret, api_passphrase)


# ______________________________________________________________________


currencies = client.get_currencies()


def find_crypto(crypto, message):
    crypto = crypto.upper()

    for m in message:
        if m['name'] == crypto:
            pprint.pprint(m)

# find_crypto('BTc', currencies)

# ______________________________________________________________________


# time1 = round(int(datetime.timestamp(datetime.utcnow())))

# message = client.get_kline_data('ADA-USDT',kline_type='1hour', start=time1)

# print(message[0])



# _time = round(int(datetime.timestamp(datetime.utcnow())))

socket_address = "wss://api.kucoin.com/api/v1/market/candles?symbol=BTC-USDT&type=1hour&startAt=1562460061&endAt=1562467061"
# socket_address = "wss://api.kucoin.com/api/v1/accounts?currency=BTC"


# # https://www.youtube.com/watch?v=32KX_xkRIOQ


# import threading

# threading.Timer(5, )



def on_open(ws):
    print('>> open')



def on_message(ws):
    print('>> message')


def on_close(ws):
    print('>> close')
    
# ________________________________


def on_error(ws, error):
    print('>> error', error)

# ________________________________


ws = websocket.WebSocketApp(
    socket_address, 
    on_open=on_open, 
    on_close=on_close,
    on_message=on_message,
    on_error=on_error
)

ws.run_forever()