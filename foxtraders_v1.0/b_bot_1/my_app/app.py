import os, websocket, json, time
import numpy as np
from pprint import pprint
from binance.client import Client
import time
from my_app import my_functions as myf
from my_app import ta_functions as ta

from my_app.trade_conditions import tc1 as tr


# rm -r __pycache__/ ./my_app/__pycache__/

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
from my_app.database import Session, Fxt_Action, Fxt_Error, Fxt_Parameters, Fxt_Settings
session = Session()
# ______________________________________________________________________
# Functions

def log_error(e, stage=None):

    error_message = f'Exception-Error {stage} >-> {e}'

    print(error_message)
    ws.close()                      

    new_error = Fxt_Error(error=error_message)
    session.add(new_error)
    session.commit()

    time.sleep(cfg.restart_time)                 
    ws.run_forever() 

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

        results = (client.get_klines(symbol=cfg.symbol.upper(), interval=Client.KLINE_INTERVAL_1HOUR)) 
        myf.process_historical_data(results) 

        

    except Exception as e: 
        log_error(e, 'Open')
        
# ______________________________________________________________________

def on_message(ws, message):

    try:           
        myf.process_message(message)       
        # ______________________________________
        # updating ATH and ATL

        if cfg.cur_close < cfg.cur_atl:
            cfg.cur_atl = cfg.cur_close
        
        if cfg.cur_close > cfg.cur_ath:
            cfg.cur_ath = cfg.cur_close
        
        # ______________________________________


        if cfg.cur_timestamp == cfg.timestamps_list[-1]:

            # update prices lists (changing last result)
            cfg.closes_list[-1] = cfg.cur_close                                 
            cfg.lows_list[-1] = cfg.cur_low
            cfg.highs_list[-1] = cfg.cur_high
            
            
            # update moving averages (changing last result)
            cfg.cur_ema = ta.ema_current(cfg.cur_close, cfg.ema_list[-2], cfg.ema_window)
            cfg.ema_list[-1] = cfg.cur_ema

            cfg.cur_sma = ta.sma_current(cfg.closes_list, cfg.sma_window)


        else:
            print('___ New Candle ___ New Candle ___ New Candle ___')

            # update timestamp
            cfg.timestamps_list = np.append(cfg.timestamps_list, cfg.cur_timestamp)

            # import parameters
            myf.import_parameters()

            # update prices lists (appending last result)
            cfg.closes_list = np.append(cfg.closes_list, float(cfg.cur_close))              
            cfg.lows_list = np.append(cfg.lows_list, float(cfg.cur_low))                    
            cfg.highs_list = np.append(cfg.highs_list, float(cfg.cur_high))

            # update moving averages (appending last result)
            cfg.cur_ema = ta.ema_current(cfg.cur_close, cfg.ema_list[-1], cfg.ema_window)  
            cfg.ema_list = np.append(cfg.ema_list, float(cfg.cur_ema))       
            
            cfg.cur_sma = ta.sma_current(cfg.closes_list, cfg.sma_window) 



        # ______________________________________

        # Selecting moving avreges and printing current results
        myf.ma_current()
        myf.print_current()
        

        # ______________________________________
        # Conditions

        tr.trade_conditions()





        # ______________________________________




    except Exception as e:
        log_error(e, 'Message')                  
    
# ________________________________

def on_close(ws):   
    try: 
        print('\nSocket-Close >->')

    except Exception as e:
        log_error(e, 'Close')
    
# ________________________________


def on_error(ws, error):
        
    try: 
        log_error(error, 'Error')

    except Exception as e:       
        log_error(e, 'Error Error')


# ________________________________

ws = websocket.WebSocketApp(
    socket_address, 
    on_open=on_open, 
    on_close=on_close,
    on_message=on_message,
    on_error=on_error
)

# ______________________________________________________________________
print('\n...so far so good!')
