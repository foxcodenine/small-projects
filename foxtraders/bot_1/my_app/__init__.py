# ______________________________________________________________________
# Imports
import os, config, websocket, json, time
import numpy as np
from binance.client import Client
from my_app import ta_function as ta

# ______________________________________________________________________
# App Configurations

def set_app_config():
    if os.getenv('MY_ENV') == 'home':
        return config.ConfigHome()

    elif os.getenv('MY_ENV') == 'work':
        return config.ConfigWork()
    else:
        return config.ConfigPro()


app = set_app_config()
# ______________________________________________________________________
from my_app.database import Fxt_Data, Session
session = Session()
# ______________________________________________________________________
# Global Variables

# historical data (numpy.array)
closes_list     = None
timestamps_list = None
emas_list       = None
smas_list       = None

# current data 
cur_close       = None
cur_timestamp   = None
cur_ema         = None
cur_sma         = None

app_switch      = True

symbol          = "adausdt"

sma_window      = 36
ema_window      = 144

# test_error = 0 # <--
# ______________________________________________________________________
# Connect to Binance accout

client = Client(api_key=app.api_key, api_secret=app.api_secret)

# ______________________________________________________________________
# print function
def print_current():
    print('EMA -> ', cur_ema, '|  SMA -> ', cur_sma, '| close -> ', cur_close)

# ______________________________________________________________________
# Binance socket

base_endpoint = "wss://stream.binance.com:9443"

kline_length ="1h"

socket_address = f"{base_endpoint}/ws/{symbol}@kline_{kline_length}"

# ____________________________________

def on_open(ws):

    print('Socket-Open')
    # global test_error # <--
    # test_error = 0 # <--

    # _______________________
    # Retrive Historical Data

    global closes_list, timestamps_list, emas_list, smas_list
    global cur_close, cur_timestamp, cur_ema, cur_sma
    
    result = client.get_klines(symbol=symbol.upper(), interval=Client.KLINE_INTERVAL_1HOUR)

    closes_list = np.array([float(r[4]) for r in result])                   # <- historical closes
    timestamps_list = np.array([r[0] for r in result])                      # <- historical timestamps
    emas_list = ta.exp_moving_average_list(closes_list, ema_window)         # <- historical emas
    smas_list = ta.simple_moving_avrage_list(closes_list, sma_window)       # <- historical smas

    cur_close     = closes_list[-1]
    cur_timestamp = timestamps_list[-1]
    cur_ema = emas_list[-1]
    cur_sma = smas_list[-1]

    print_current()
    # ________________________________
    # save to db
    new_candle = Fxt_Data(price=cur_close, ema144=cur_ema, sma36=cur_sma, new='start_app')
    session.add(new_candle)
    session.commit()

# ______________________________________________________________________
# ______________________________________________________________________
def on_message(ws, message):    

    try:    
        global closes_list, timestamps_list, emas_list
        global cur_close, cur_timestamp, cur_sma , cur_ema

        # global test_error # <--
        # test_error += 1 #<--
        # if test_error > 3: # <--
        #     raise ValueError('text_error > 3') # <--

        
        # _________________________

        cur_timestamp   = json.loads(message)['k']['t']
        cur_close = float(json.loads(message)['k']['c'])

        # _________________________


        if cur_timestamp == timestamps_list[-1]:
            
            print('___ Same Candle ___ ')

            closes_list[-1] = cur_close                                 # replacing closes_list[-1] with cur_close 
           
            cur_ema = ta.current_ema(cur_close, emas_list[-2], ema_window)
            emas_list[-1] = cur_ema

            cur_sma = ta.current_sma(closes_list, sma_window)   

        else:
            print('___ New Candle ___ New Candle ___ New Candle ___')
              

            closes_list = np.append(closes_list, float(cur_close))              # append cur_close to closes_list list
            timestamps_list = np.append(timestamps_list, cur_timestamp)         # append cur_timestamp to timestamps_list list

            cur_ema = ta.current_ema(cur_close, emas_list[-1], ema_window)  
            emas_list = np.append(emas_list, float(cur_ema))       
            
            cur_sma = ta.current_sma(closes_list, sma_window)  


            # __________________________________________________________
            # save to db
            # session.query(Fxt_Data).filter(Fxt_Data.new == 'False').delete(synchronize_session=False)
            new_candle = Fxt_Data(price=cur_close, ema144=cur_ema, sma36=cur_sma, new='True')
            session.add(new_candle)            
            session.commit()  
            # __________________________________________________________                   
        # ______________________________________________________________
        # Buy selling code
        print_current()
        # ______________________________________________________________

    except Exception as e:
        print('error ->', e)
        ws.close()          # stop loop
        time.sleep(900)     # what 30min
        ws.run_forever()    # restart loop
   
# ______________________________________________________________________
# ______________________________________________________________________
   

def on_close(ws):
    print('Socket-Close')

def on_error(ws, error):
    print('Socket-Error')
    print(error)
# ______________________________________________________________________
# ______________________________________________________________________

ws = websocket.WebSocketApp(
    socket_address, 
    on_open=on_open, 
    on_close=on_close,
    on_message=on_message,
    on_error=on_error
)
ws.run_forever()


