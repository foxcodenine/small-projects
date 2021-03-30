# ______________________________________________________________________
# Imports
import os, config, websocket, json, time
import numpy as np
from binance.client import Client
from my_app import ta_function as ta

from binance.enums import SIDE_BUY, SIDE_SELL, ORDER_TYPE_MARKET
from binance.exceptions import BinanceAPIException

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
from my_app.database import Session, Fxt_Data, Fxt_Action, Fxt_Error
from _settings import Fxt_Settings
session = Session()

########################################################################
# Global Variables

# ______________________________________
# Historical Data (numpy.array)

closes_list     = None
timestamps_list = None
emas_list       = None
smas_list       = None

# ______________________________________
# Current data 

cur_close       = None
cur_timestamp   = None
cur_ema         = None
cur_sma         = None

# ______________________________________
# Non Adjustable Variables

kline_length ="1h" # <-- also need to update in Resalt @ Retrive Historical Data
                   #     look for "# <- (AAA)"
buy_price       = 0
sell_timestamp  = None

# ______________________________________
# On Open Variables

symbol1         = "ada"
symbol2         = "usdt"
symbol          = symbol1 + symbol2

in_position     = False
sell_conditions = False
buy_conditions  = False

# ______________________________________
# Tradind Qty Variables

sell_qty       = 10
buy_qty        = 10

# ______________________________________
# Moving Avrages Variables

sma_window      = 36
ema_window      = 144

sma_offset      = 0
ema_offset      = 0

# ______________________________________
# Selling Variables

sell_percentage = 1.08
sell_in_profit  = 1.35
over_sma        = 1.175

# ______________________________________
# Buying Variables

buy_gap         = 1.006

rebuy_count     = 0
rebuy_max       = 5
rebuy_gap       = 1.006

# ______________________________________
# Moving Stop Loss

msl             = 0
msl_on          = True
msl_per         = 0.95

# ______________________________________
# test_error = 0 # <--


########################################################################

# ______________________________________________________________________
# Connect to Binance accout

client = Client(api_key=app.api_key, api_secret=app.api_secret)

# ______________________________________________________________________
# Helper functions
def print_currents():
    print('EMA -> ', cur_ema, '|  SMA -> ', cur_sma, '| close -> ', cur_close)

# _____________________________

def save_to_fxt_action(action, price):
        new_action = Fxt_Action(action=action, price=price)
        session.add(new_action)
        session.commit()
# _____________________________

def binance_order(action, qty, sym1, sym2, price):

    if app.env != 'production':
        print('Bot in test mode!')
        return 'Bot in test mode!'
    # __________________________________

    price = float(price)
    if action == 'buy':
        side = SIDE_BUY
        message =  f'BUY {sym1} {qty} for {sym2} {round(price * qty, 2)}'

    if action == 'sell':
        side = SIDE_SELL
        message = f'SELL {sym1} {qty} for {sym2} {round(price * qty, 2)}'
    
    symbol = f'{sym1}{sym2}'.upper()
    # __________________________________

    try:
        order = client.create_order(
            symbol = symbol,
            side = side,
            type = ORDER_TYPE_MARKET,
            quantity = qty
        )
        
        print('\n',f'Placed {action} order!!') 
        return message
    # __________________________________

    except BinanceAPIException as e:
        print( f'{action.upper()} ERROR | Binance Error -> {e}')
        return f'{action.upper()} ERROR | Binance Error -> {e}'

# ______________________________________________________________________
def loading_settings():
    global sell_qty, buy_qty, sma_window, ema_window, sma_offset, ema_offset 

    sell_qty   =  float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sell_qty').first().value)
    buy_qty    =  float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'buy_qty').first().value)

    sma_window =  int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sma_window').first().value)
    ema_window =  int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'ema_window').first().value)

    sma_offset =  float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sma_offset').first().value)
    ema_offset =  float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'ema_offset').first().value)
# ______________________________________________________________________
# Binance socket


symbol1 =  session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol1').first().value
symbol2 =  session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol2').first().value
symbol = symbol1 + symbol2

in_position =      bool(int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'in_position').first().value))
sell_conditions =  bool(int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sell_conditions').first().value))
buy_conditions =   bool(int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'buy_conditions').first().value))

# ______________________________________________________________________
# Binance socket

base_endpoint = "wss://stream.binance.com:9443"
socket_address = f"{base_endpoint}/ws/{symbol}@kline_{kline_length}"


########################################################################
########################################################################

def on_open(ws):

    print('Socket-Open')
    # global test_error # <--
    # test_error = 0 # <--

    # _______________________
    # Retrive Historical Data

    global closes_list, timestamps_list, emas_list, smas_list
    global cur_close, cur_timestamp, cur_ema, cur_sma
       
    
    loading_settings()
    
    
    result = client.get_klines(symbol=symbol.upper(), interval=Client.KLINE_INTERVAL_1HOUR) # <- (AAA)

    closes_list = np.array([float(r[4]) for r in result])                   # <- historical closes
    timestamps_list = np.array([r[0] for r in result])                      # <- historical timestamps
    emas_list = ta.exp_moving_average_list(closes_list, ema_window)         # <- historical emas
    smas_list = ta.simple_moving_avrage_list(closes_list, sma_window)       # <- historical smas

    cur_close     = closes_list[-1]
    cur_timestamp = timestamps_list[-1]
    cur_ema = emas_list[-1]
    cur_sma = smas_list[-1]

    print_currents()
    # ________________________________
    # save to db
    new_candle = Fxt_Data(price=cur_close, ema=cur_ema, sma=cur_sma, status='start_app')
    session.add(new_candle)
    session.commit()


########################################################################
########################################################################


def on_message(ws, message): 

    try:    
        global closes_list, timestamps_list, emas_list
        global cur_close, cur_timestamp, cur_sma , cur_ema
        global in_position, sell_conditions, buy_conditions
        global sell_percentage, sell_timestamp, rebuy_count, buy_price, msl
        

        # _________________________

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

            print(f'<-{sell_qty}-> <-{buy_qty}->') # <- <-

            closes_list[-1] = cur_close                                         # replacing closes_list[-1] with cur_close 
           
            cur_ema = ta.current_ema(cur_close, emas_list[-2], ema_window)
            emas_list[-1] = cur_ema

            cur_sma = ta.current_sma(closes_list, sma_window)   

        else:
            print('___ New Candle ___ New Candle ___ New Candle ___')
              
            loading_settings()
            
            closes_list = np.append(closes_list, float(cur_close))              # append cur_close to closes_list list
            timestamps_list = np.append(timestamps_list, cur_timestamp)         # append cur_timestamp to timestamps_list list

            cur_ema = ta.current_ema(cur_close, emas_list[-1], ema_window)  
            emas_list = np.append(emas_list, float(cur_ema))       
            
            cur_sma = ta.current_sma(closes_list, sma_window)  

            if cur_close * msl_per > msl:                               # updating the moving stop loss
                msl = cur_close * msl_per


            # __________________________________________________________
            # save to db
            # session.query(Fxt_Data).filter(Fxt_Data.new == 'False').delete(synchronize_session=False)
            new_candle = Fxt_Data(price=cur_close, ema=cur_ema, sma=cur_sma, status='new_candle')
            session.add(new_candle)            
            session.commit()  
            # __________________________________________________________                   

        print_currents()

        # ______________________________________________________________
        # ______________________________________________________________
        # ______________________________________________________________
        # Buy And Selling Conditions!!!

        if in_position:

            if cur_close < (cur_ema + ema_offset):
                # ACTION STOP LOSS
                # binance_order(action, qty, sym1, sym2, cur_close)
                message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                save_to_fxt_action(f'stop_loss {message}', cur_close)
                in_position = False
                sell_conditions = False
                buy_conditions  = True
            
            
            else:
                if buy_price and cur_close/buy_price > sell_in_profit:
                    # ACTION SELL (PRICE % OVER BUY)
                    message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                    save_to_fxt_action(f'sell_+{round((sell_in_profit-1)*100,1)}% {message}', cur_close)
                    in_position = False
                    sell_conditions = False
                
                elif cur_close/(cur_sma + sma_offset) > over_sma and (cur_sma + sma_offset) > (cur_ema + ema_offset):
                    # ACTION SELL (PRICE % OVER SMA)
                    message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                    save_to_fxt_action(f'sell_+{round((over_sma - 1) * 100, 1)}%_over_sma {message}', cur_close)
                    in_position = False
                    sell_conditions = False
                
                elif msl_on and msl > cur_close and cur_close > (cur_ema + ema_offset) and cur_close > buy_price:
                    # ACTION SELL (PRICE UNDER MSL) 
                    message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                    save_to_fxt_action('sell_price_under_msl', cur_close)
                    in_position = False
                    sell_conditions = False

                elif cur_close > (cur_sma + sma_offset) and sell_conditions == False:
                    # SELL CONDITIONS ON
                    save_to_fxt_action('sell_condition_on', cur_close)
                    sell_conditions = True
                
                elif cur_close < (cur_sma + sma_offset) and sell_conditions == True and (cur_sma + sma_offset)/(cur_ema + ema_offset) > sell_percentage:
                    # ACTION SELL (PRICE UNDER SMA) 
                    message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                    save_to_fxt_action(f'sell_{round((sell_percentage - 1) * 100, 1)}%_sma_to_ema {message}', cur_close)
                    in_position = False
                    sell_conditions = False
                    sell_timestamp = cur_timestamp

                elif cur_close < (cur_sma + sma_offset) and sell_conditions == True:
                    # SELL CONDITIONS OFF
                    save_to_fxt_action('sell_condition_off', cur_close)
                    sell_conditions = False
        
        if not in_position:

            if cur_close < (cur_ema + ema_offset) and buy_conditions == False:
                # RESET BUY CONDITIONS
                save_to_fxt_action('reset_buy_condition', cur_close)
                buy_conditions  = True

            elif cur_close > ((cur_ema + ema_offset) * buy_gap ) and buy_conditions == True:
                # ACTION BUY (PRICE OVER EMA)
                message = binance_order(action='buy', qty=buy_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                save_to_fxt_action(f'buy {message}', cur_close)
                in_position = True
                buy_conditions  = False
                sell_conditions = False
                rebuy_count = 0
                buy_price = cur_close
                msl = 0
            
            elif (cur_sma + sma_offset) > (cur_ema + ema_offset) and sell_timestamp == cur_timestamp and rebuy_count <= rebuy_max and cur_close > ((cur_sma + sma_offset) * rebuy_gap):
                # ACTION RE_BUY (PRICE RE-OVER SMA)
                message = binance_order(action='buy', qty=buy_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                save_to_fxt_action(f'rebuy {message}', cur_close)
                rebuy_count += 1
                in_position = True
                buy_conditions  = False
                sell_conditions = True

        # ______________________________________________________________

    except Exception as e:

        print('error ->', e)
        ws.close()                      # <- stop loop

        new_error = Fxt_Error(error=e)  # <- save to db
        session.add(new_error)
        session.commit()

        time.sleep(900)                 # <- what 30min
        ws.run_forever()                # <- restart loop
   
########################################################################
########################################################################
   
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


bot_on =  bool(int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'bot_on').first().value))

if bot_on:
    ws.run_forever()
else:
    print('Bot is switched off!')


