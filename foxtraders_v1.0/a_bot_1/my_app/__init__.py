# ______________________________________________________________________
# Imports
import os, websocket, json, time
import numpy as np
from pprint import pprint
from binance.client import Client
import time

# ______________________________________________________________________
# Global Variables

from my_app.global_variables import *

# ______________________________________________________________________
# Connect Client to Binance account

api_key = os.getenv('API_KEY_BINANCE')
api_secret = os.getenv('API_SECRET_BINANCE')

client = Client(api_key, api_secret)

# ______________________________________________________________________
# Database

from my_app.database import Fxt_Parameters, Fxt_Current, Fxt_Error, Session
session = Session()

# ______________________________________________________________________
# Functions

from my_app import my_function as myf


def exception_error(code, error):

    print(f'Exception-Error-{code} >-> {error}')
    ws.close()                      # <- stop loop

    new_error = Fxt_Error(error=f'Exception-Error-{code} >-> {error}')  # <- save to db
    session.add(new_error)
    session.commit()

    time.sleep(restart_time)        # <- wait 5min
    ws.run_forever()                # <- restart loop




# ______________________________________________________________________
# Binance socket

base_endpoint = os.getenv('BINANCE_BASE_ENDPOINT')
kline_length  = os.getenv('KLINE_LENGTH')

socket_address = f"{base_endpoint}/ws/{symbol.lower()}@kline_{kline_length}"

# ______________________________________________________________________

def on_open(ws):
    try: 
        print('Socket-Open >->')

        myf.import_settings('P1')
        myf.import_settings('P2')
        myf.import_settings('P3')

    except Exception as e:
        print(e)
    
# ________________________________


def on_message(ws, message):
    global cur_timestamp, cur_close, cur_atl, cur_ath
    global p_1, p_2, p_3
    try: 


        message = json.loads(message)        
        cur_close     = message['k']['c']  
        # print('>->', cur_timestamp, cur_close)


        if cur_timestamp == message['k']['t']:
            print('___ Same Candle ___ ')

        else:
            print('___ New Candle ___ New Candle ___ New Candle ___')
            cur_timestamp = message['k']['t']

            myf.import_settings('P1')
            myf.import_settings('P2')
            myf.import_settings('P3')


    except Exception as e:
        exception_error('On-Message', e)
        
# ________________________________

def on_close(ws):
    try: 
        print('Socket-Close >->')
    except Exception as e:
        exception_error('On-Close', e)
    
# ________________________________


def on_error(ws, error):
    try: 
        exception_error('Socket-Error', error)
    except Exception as e:
        exception_error('On-Error', e)

# ________________________________


ws = websocket.WebSocketApp(
    socket_address, 
    on_open=on_open, 
    on_close=on_close,
    on_message=on_message,
    on_error=on_error
)


# ______________________________________________________________________


