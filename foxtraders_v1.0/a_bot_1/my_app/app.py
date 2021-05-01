# ______________________________________________________________________
# Imports
import os, websocket, json, time
import numpy as np
from pprint import pprint
from binance.client import Client
import time

from pymysql.err import ProgrammingError

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

from my_app.database import Fxt_Parameters, Fxt_Action, Fxt_Error, Fxt_Settings, Session
session = Session()

# ______________________________________________________________________
# Functions

def log_error(code, error):

    print(f'Exception-Error-{code} >-> {error}')
    ws.close()                      # <- stop loop

    new_error = Fxt_Error(error=f'Exception-Error-{code} >-> {error}')  # <- save to db
    session.add(new_error)
    session.commit()

    time.sleep(restart_time)        # <- wait 5min
    ws.run_forever()                # <- restart loop


# ________________________________


def import_parameters(p):
    
    global p_1, p_2, p_3, p_4, p_5

    s = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == p.name).first()
    p.active = bool(int(s.active))
    p.amount = float(s.amount)
    p.sell_target = round(float(s.sell_target) * (1 + float(s.sell_trail) / 100), 6)
    p.sell_trail  = 1 - float(s.sell_trail) / 100

    p.buy_target = round(float(s.buy_target) * (1 - float(s.buy_trail) / 100), 6) 
    p.buy_trail  = 1 + float(s.buy_trail) / 100
    p.target_reached = bool(int(s.target_reached)) 

# ________________________________

def import_settings():
    global app_mode, symbol1, symbol2, symbol, restart_time

    app_mode = session.query(Fxt_Settings).filter(Fxt_Settings.name == 'mode').first().value
    symbol1 = session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol1').first().value.upper()
    symbol2 = session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol2').first().value.upper()
    symbol = symbol1 + symbol2
    restart_time = int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'restart_time').first().value.upper())
    
    print(app_mode, symbol)

# ________________________________

from my_app import my_function as myf
from my_app.conditions import conditions_function   


# ______________________________________________________________________
# Init settings

import_settings()


# ______________________________________________________________________
# Binance socket

base_endpoint = os.getenv('BINANCE_BASE_ENDPOINT')
kline_length  = os.getenv('KLINE_LENGTH')

socket_address = f"{base_endpoint}/ws/{symbol.lower()}@kline_{kline_length}"


# ______________________________________________________________________

def on_open(ws):

    try: 
        print('Socket-Open >->')

        global cur_timestamp
        cur_timestamp = '' 

    except Exception as e:           
            log_error('On-Open', e)
    
# ________________________________


def on_message(ws, message):
    global cur_timestamp, cur_close, cur_atl, cur_ath
    global p_1, p_2, p_3, p_4, p_5
    try: 
    # __________________________________________________________________
    # Fetch Data

        message = json.loads(message)        
        cur_close = float(message['k']['c'] ) 
        
    # __________________________________________________________________
    # Updating All time High and Low

        if not cur_ath:
            cur_ath = cur_close
        elif cur_close > cur_ath:
            cur_ath = cur_close

        if not cur_atl:
            cur_atl = cur_close 
        elif cur_close < cur_atl:
            cur_atl = cur_close

        print(f'Close: {cur_close}, ATH: {cur_ath}, ATL: {cur_atl}')

        if cur_timestamp == message['k']['t']:
            # print('___ Same Candle ___ ')
            pass

        else:
            print('___ New Candle ___ New Candle ___ New Candle ___')
            cur_timestamp = message['k']['t']
            
            import_parameters(p_1)
            import_parameters(p_2)
            import_parameters(p_3)
            import_parameters(p_4)
            import_parameters(p_5)


    # __________________________________________________________________
    # Conditions:    
        
        conditions_function(p_1, cur_close, cur_ath, cur_atl, app_mode)
        conditions_function(p_2, cur_close, cur_ath, cur_atl, app_mode)
        conditions_function(p_3, cur_close, cur_ath, cur_atl, app_mode)
        conditions_function(p_4, cur_close, cur_ath, cur_atl, app_mode)
        conditions_function(p_5, cur_close, cur_ath, cur_atl, app_mode)

    # __________________________________________________________________

    except Exception as e:
        log_error('On-Message', e)
        
# ________________________________

def on_close(ws):
    try: 
        
        print('Socket-Close >->')
    except Exception as e:
        
        log_error('On-Close', e)
    
# ________________________________


def on_error(ws, error):
    try: 
        log_error('Socket-Error', error)

    except Exception as e:
        log_error('On-Error', e)

# ________________________________


ws = websocket.WebSocketApp(
    socket_address, 
    on_open=on_open, 
    on_close=on_close,
    on_message=on_message,
    on_error=on_error
)


# ______________________________________________________________________


