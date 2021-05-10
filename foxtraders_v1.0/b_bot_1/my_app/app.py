import os, websocket, json, time
import numpy as np
from pprint import pprint
from binance.client import Client
import time
from my_app import my_functions as myf

from pymysql.err import ProgrammingError


# ______________________________________________________________________
# Global Variables

import my_app.config as cfg

# ______________________________________________________________________
# Connect Client to Binance account

api_key = os.getenv('API_KEY_BINANCE')
api_secret = os.getenv('API_SECRET_BINANCE')

client = Client(api_key, api_secret)

# ______________________________________________________________________
# Database


# ______________________________________________________________________
# Functions


# ______________________________________________________________________
# Init Settings
myf.import_settings()

# ______________________________________________________________________
# Socket Address

base_endpoint = os.getenv('BINANCE_BASE_ENDPOINT')
kline_length  = os.getenv('KLINE_LENGTH')

socket_address = f"{base_endpoint}/ws/{cfg.symbol.lower()}@kline_{kline_length}"



# ______________________________________________________________________
# Websockets

def on_open(ws):

    try:
        print('\nSocket-Open >->')
        myf.import_parameters()        

        historical_data = client.get_klines(symbol=cfg.symbol.upper(), interval=Client.KLINE_INTERVAL_1HOUR)        

    except Exception as e:

        print('Exception-Error >->', e)
        ws.close()                     

        # Save to db

        time.sleep(cfg.restart_time)    
        ws.run_forever()
        
# ________________________________

def on_message(ws, message):
    print('message')
    # try:    
    # except Exception as e:        
    
# ________________________________

def on_close(ws):
    print('\nSocket-Close >->')
    # try: 
        
    #     print('Socket-Close >->')
    # except Exception as e:
        
    #     log_error('On-Close', e)
    
# ________________________________


def on_error(ws, error):
        print('\nSocket-Error >->')
    # try: 
    #     log_error('Socket-Error', error)

    # except Exception as e:
    #     log_error('On-Error', e)

# ________________________________

ws = websocket.WebSocketApp(
    socket_address, 
    on_open=on_open, 
    on_close=on_close,
    on_message=on_message,
    on_error=on_error
)
from my_app import my_functions
# ______________________________________________________________________
print('\n...so far so good!')
