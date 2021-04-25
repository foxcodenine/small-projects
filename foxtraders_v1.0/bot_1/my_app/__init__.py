# ______________________________________________________________________
# Imports
import os, config, websocket, json, time
import numpy as np
from binance.client import Client
from my_app import ta_function as ta

from binance.enums import SIDE_BUY, SIDE_SELL, ORDER_TYPE_MARKET
from binance.exceptions import BinanceAPIException

from datetime import datetime

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
from _settings import Fxt_Settings, Fxt_Current
session = Session()

########################################################################
# Global Variables

# ______________________________________
# Historical Data (numpy.array)

closes_list     = None
highs_list      = None
lows_list       = None
timestamps_list = None
emas_list       = None
smas_list       = None
atr_list        = None

# ______________________________________
# Current data 

cur_close       = None
cur_high        = None
cur_low         = None
cur_timestamp   = None
cur_ema         = None
cur_sma         = None
cur_atr         = None


# ______________________________________
# Non Adjustable Variables

kline_length ="1h" # <-- also need to update in Resalt @ Retrive Historical Data
                   #     look for "# <- (AAA)"

sell_timestamp  = None
cur_msl             = 0 # (current moving stoploss, will be adjusted automaticaly)
cur_trail           = 0
cur_atl             = 0
target_reached      = False
# ______________________________________
# On Open Variables

symbol1         = "ada"
symbol2         = "usdt"
symbol          = symbol1 + symbol2

buy_price       = 0

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
sell_target  = 1.35
over_sma        = 1.175

# ______________________________________
# Buying Variables

buy_gap         = 1.00
rebuy_gap       = 1.00
rebuy_count     = 0
rebuy_max       = 5


atr_window      = 14
atr_multi       = 2    


# ______________________________________
# Moving Stop Loss

msl_on          = True
msl_per         = 0.95


# ______________________________________
# Trailing

trailing_on = False
trailing_per = 0.98

# ______________________________________
# test_error = 0 # <--


########################################################################

# ______________________________________________________________________
# Connect to Binance accout

client = Client(api_key=app.api_key, api_secret=app.api_secret)

# ______________________________________________________________________
# Helper functions
def print_currents():
    
    print(
        symbol,
        ' price:',  round(cur_close, 5),
        ' ema:',    round(cur_ema, 5),
        ' sma:',    round(cur_sma, 5),
        ' atr:',    round(cur_atr, 5),
        ' spl:',    round(cur_ema + ema_offset - (cur_atr * atr_multi), 5),
        ' msl:',    round(cur_msl, 5),
        ' trail:',  round(cur_trail, 5),
        ' target reached:', target_reached
        
    )

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
        print('Binance API Exception >->')
        print( f'{action.upper()} ERROR | Binance Error -> {e}')
        return f'{action.upper()} ERROR | Binance Error -> {e}'

# ______________________________________________________________________
def loading_settings():
    global sell_qty, buy_qty, sma_window, ema_window,  sma_offset, ema_offset 
    global sell_percentage, sell_target, over_sma, msl_on, msl_per
    global buy_gap, rebuy_gap, rebuy_count, rebuy_max, trailing_on, trailing_per
    global atr_window, atr_multi

    print('Loading Settings >->')

    sell_qty   =  float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sell_qty').first().value)
    buy_qty    =  float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'buy_qty').first().value)

    sma_window =  int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sma_window').first().value)
    ema_window =  int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'ema_window').first().value)
    atr_window =  int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'atr_window').first().value)
    atr_multi =   float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'atr_multi').first().value)

    sma_offset =  float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sma_offset').first().value)
    ema_offset =  float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'ema_offset').first().value)

    sell_percentage = float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sell_percentage').first().value)
    sell_target  = float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'sell_target').first().value)
    over_sma        = float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'over_sma').first().value)

    buy_gap = float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'buy_gap').first().value)
    rebuy_gap   = float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'rebuy_gap').first().value)
    rebuy_count = int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'rebuy_count').first().value)
    rebuy_max   = int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'rebuy_max').first().value)

    msl_on =  bool(int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'msl_on').first().value))
    msl_per = float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'msl_per').first().value)

    trailing_on =  bool(int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'trailing_on').first().value))
    trailing_per = float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'trailing_per').first().value)
# ______________________________________________________________________

def upload_settings(code):
    
    session.query(Fxt_Current).filter(
        Fxt_Current.name == 'in_position'
    ).update({'value': int(in_position)}, synchronize_session=False)

    session.query(Fxt_Current).filter(
        Fxt_Current.name == 'buy_price'
    ).update({'value': buy_price}, synchronize_session=False)

    session.query(Fxt_Current).filter(
        Fxt_Current.name == 'sell_conditions'
    ).update({'value': int(sell_conditions)}, synchronize_session=False)

    session.query(Fxt_Current).filter(
        Fxt_Current.name == 'buy_conditions'
    ).update({'value': int(buy_conditions)}, synchronize_session=False)
    session.commit()

    session.query(Fxt_Current).filter(
        Fxt_Current.name == 'datetime'
    ).update({'value': f'{datetime.utcnow()}'}, synchronize_session=False)
    session.commit()

    session.query(Fxt_Current).filter(
        Fxt_Current.name == 'code'
    ).update({'value': code}, synchronize_session=False)
    session.commit()

# ______________________________________________________________________
# Binance socket


symbol1 =  session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol1').first().value
symbol2 =  session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol2').first().value
symbol = symbol1 + symbol2

buy_price = float(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'buy_price').first().value)

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

    print('Socket-Open >->')
    # global test_error # <--
    # test_error = 0 # <--

    # _______________________
    # Retrive Historical Data

    global closes_list, timestamps_list, emas_list, smas_list, lows_list, highs_list
    global cur_close, cur_timestamp, cur_ema, cur_sma, cur_low, cur_high, cur_atr
    global atr_list, cur_atr, cur_atl
       
    
    loading_settings()
    
    
    result = client.get_klines(symbol=symbol.upper(), interval=Client.KLINE_INTERVAL_1HOUR) # <- (AAA)

    closes_list = np.array([float(r[4]) for r in result])                   # <- historical closes
    lows_list = np.array([float(r[3]) for r in result])                     # <- historical lows
    highs_list = np.array([float(r[2]) for r in result])                    # <- historical highs
    timestamps_list = np.array([r[0] for r in result])                      # <- historical timestamps
    emas_list = ta.exp_moving_average_list(closes_list, ema_window)         # <- historical emas
    smas_list = ta.simple_moving_avrage_list(closes_list, sma_window)       # <- historical smas

    cur_close     = closes_list[-1]
    cur_high      = highs_list[-1]
    cur_low       = lows_list[-1]
    cur_timestamp = timestamps_list[-1]
    cur_ema = emas_list[-1]
    cur_sma = smas_list[-1]


    atr_list = ta.average_true_range_list(closes_list, lows_list, highs_list, atr_window)
    cur_atr = atr_list[-1]
    cur_atl = cur_ema



    print_currents()
    # ________________________________
    # save to db
    new_candle = Fxt_Data(price=cur_close, ema=cur_ema, sma=cur_sma, atr=cur_atr,  status='start_app')
    session.add(new_candle)
    session.commit()

    upload_settings('OPEN')


########################################################################
########################################################################


def on_message(ws, message): 

    try:    
        global closes_list, timestamps_list, emas_list, lows_list, highs_list
        global cur_close, cur_timestamp, cur_sma , cur_ema, cur_low, cur_high
        global in_position, sell_conditions, buy_conditions
        global sell_percentage, sell_timestamp, rebuy_count, buy_price, cur_msl
        global cur_trail, target_reached
        global atr_list, cur_atr, cur_atl
        

        # _________________________

        # global test_error # <--
        # test_error += 1 #<--
        # if test_error > 3: # <--
        #     raise ValueError('text_error > 3') # <--

        
        # _________________________

        cur_timestamp   = json.loads(message)['k']['t']
        cur_close = float(json.loads(message)['k']['c'])
        cur_low   = float(json.loads(message)['k']['l'])
        cur_high  = float(json.loads(message)['k']['h'])

        # _________________________


        if cur_timestamp == timestamps_list[-1]:
            
            print('___ Same Candle ___ ')

            
            closes_list[-1] = cur_close                                 # replacing closes_list[-1] with cur_close 
            lows_list[-1] = cur_low
            highs_list[-1] = cur_high
            
           
            cur_ema = ta.current_ema(cur_close, emas_list[-2], ema_window)
            emas_list[-1] = cur_ema

            cur_sma = ta.current_sma(closes_list, sma_window) 

            if cur_close * msl_per > cur_msl:                           # updating the moving stop loss value
                cur_msl = cur_close * msl_per 

            if cur_close * trailing_per > cur_trail:                    # updating the traling value
                cur_trail = cur_close * trailing_per
            
            if cur_close < cur_atl:
                cur_atl = cur_close



        else:
            print('___ New Candle ___ New Candle ___ New Candle ___')

            loading_settings()
    
            closes_list = np.append(closes_list, float(cur_close))              # append cur_close to closes_list list
            lows_list = np.append(lows_list, float(cur_low))                    
            highs_list = np.append(highs_list, float(cur_high))                 
            timestamps_list = np.append(timestamps_list, cur_timestamp)         # append cur_timestamp to timestamps_list list

            cur_ema = ta.current_ema(cur_close, emas_list[-1], ema_window)  
            emas_list = np.append(emas_list, float(cur_ema))       
            
            cur_sma = ta.current_sma(closes_list, sma_window)  

            if cur_close * msl_per > cur_msl:                           # updating the moving stop loss
                cur_msl = cur_close * msl_per

            if cur_close * trailing_per > cur_trail:                    # updating the traling value
                cur_trail = cur_close * trailing_per

            if cur_close < cur_atl:
                cur_atl = cur_close

            cur_atr = ta.average_true_range(
                closes_list[-2], lows_list[-2], highs_list[-2], 
                cur_close, cur_low, cur_high, 
                atr_list[-1], atr_window
            )
            atr_list.append(cur_atr)

            # __________________________________________________________
            # save to db
            # session.query(Fxt_Data).filter(Fxt_Data.new == 'False').delete(synchronize_session=False)
            new_candle = Fxt_Data(price=cur_close, ema=cur_ema, sma=cur_sma, atr=cur_atr, status='new_candle')
            session.add(new_candle)            
            session.commit()  
            # __________________________________________________________                   

        print_currents()

        # ______________________________________________________________
        # ______________________________________________________________
        # ______________________________________________________________
        # Buy And Selling Conditions!!!

        if in_position:

            if cur_close < (cur_ema + ema_offset - (cur_atr * atr_multi * 1.5)):
                print('AAA')
                # ACTION STOP LOSS
                # binance_order(action, qty, sym1, sym2, cur_close)
#                message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
#                save_to_fxt_action(f'stop_loss {message}', cur_close)
#                in_position = False
#                sell_conditions = False
#                buy_conditions  = True
#                upload_settings('AAA')
            
            
            else:
                if buy_price and cur_close/buy_price > sell_target and not target_reached:
                    print('BBB')

                    if not trailing_on:
                        print('CCC')
                        # ACTION SELL (TARGET REACHED) (Test Ok)
                        message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                        save_to_fxt_action(f'sell_target_reached_+{round((sell_target-1)*100,1)}% {message}', cur_close)
                        in_position = False
                        sell_conditions = False 
                        upload_settings('CCC')

                    elif not target_reached:
                        print('DDD')
                        target_reached = True
                        save_to_fxt_action('target_reached', cur_close)
                        upload_settings('DDD')

                elif target_reached and cur_close < cur_trail and cur_close > cur_ema:
                    print('EEE')
                    # ACTION SELL (TARGET REACHED TRAILING) 
                    message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                    save_to_fxt_action(f'sell_traling_+{round(((cur_close / buy_price) - 1)*100,1)}% {message}', cur_close)
                    in_position = False
                    sell_conditions = False
                    target_reached = False
                    upload_settings('EEE')
                
                elif cur_close/(cur_sma + sma_offset) > over_sma and (cur_sma + sma_offset) > (cur_ema + ema_offset):
                    print('FFF')
                    # ACTION SELL (PRICE % OVER SMA)                
                    message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                    save_to_fxt_action(f'sell_+{round((over_sma - 1) * 100, 1)}%_over_sma {message}', cur_close)
                    in_position = False
                    sell_conditions = False
                    upload_settings('FFF')

                
                elif msl_on and cur_close < cur_msl and cur_close > (cur_ema + ema_offset) and cur_close > buy_price:
                    print('GGG')
                    # ACTION SELL (PRICE UNDER MSL) 
                    message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                    save_to_fxt_action('sell_price_under_msl', cur_close)
                    in_position = False
                    sell_conditions = False
                    upload_settings('GGG')

                elif cur_close > (cur_sma + sma_offset) and sell_conditions == False:
                    print('HHH')
                    # SELL CONDITIONS ON (Test Ok)
                    save_to_fxt_action('sell_condition_on', cur_close)
                    sell_conditions = True
                    upload_settings('HHH')
                
                elif cur_close < (cur_sma + sma_offset) and sell_conditions == True and (cur_sma + sma_offset)/(cur_ema + ema_offset) > sell_percentage:
                    print('III')
                    # ACTION SELL (PRICE UNDER SMA) (Test Ok)
                    message = binance_order(action='sell', qty=sell_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                    save_to_fxt_action(f'sell_{round((sell_percentage - 1) * 100, 1)}%_sma_to_ema {message}', cur_close)
                    in_position = False
                    sell_conditions = False
                    sell_timestamp = cur_timestamp
                    upload_settings('III')

                elif cur_close < (cur_sma + sma_offset) and sell_conditions == True:
                    print('JJJ')
                    # SELL CONDITIONS OFF
                    save_to_fxt_action('sell_condition_off', cur_close)
                    sell_conditions = False
                    upload_settings('JJJ')
        
        if not in_position:

            if cur_close < (cur_ema + ema_offset) and buy_conditions == False:
                print('KKK')
                # RESET BUY CONDITIONS (Test Ok)
                save_to_fxt_action('reset_buy_condition', cur_close)
                buy_conditions  = True
                upload_settings('KKK')
                cur_atl = cur_ema
            
            elif buy_conditions and cur_atl/cur_ema <= 0.999 and cur_close/cur_atl >= 1.006:
                print('ZZZ')
                # ACTION BUY (BUY PRICE UNDER EMA) 
                message = binance_order(action='buy', qty=buy_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                save_to_fxt_action(f'buy price under {(cur_close/cur_ema - 1) * 100}% {message}', cur_close)
                in_position = True
                buy_conditions  = False
                sell_conditions = False
                rebuy_count = 0
                buy_price = cur_close
                cur_msl = 0
                cur_trail = 0
                target_reached = False
                upload_settings('ZZZ')


            elif cur_close > (((cur_ema + ema_offset) * buy_gap) + (cur_atr * atr_multi * 0.5)) and buy_conditions == True:
                print('LLL')
                # ACTION BUY (PRICE OVER EMA) (Test Ok)
                message = binance_order(action='buy', qty=buy_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                save_to_fxt_action(f'buy {message}', cur_close)
                in_position = True
                buy_conditions  = False
                sell_conditions = False
                rebuy_count = 0
                buy_price = cur_close
                cur_msl = 0
                cur_trail = 0
                target_reached = False
                upload_settings('LLL')
            
            elif (cur_sma + sma_offset) > (cur_ema + ema_offset) and sell_timestamp == cur_timestamp and rebuy_count < rebuy_max and cur_close > ((cur_sma + sma_offset) * rebuy_gap):
                print('MMM')
                # ACTION RE_BUY (PRICE RE-OVER SMA)
                message = binance_order(action='buy', qty=buy_qty, sym1=symbol1, sym2=symbol2, price=cur_close)
                save_to_fxt_action(f'rebuy {message}', cur_close)
                rebuy_count += 1
                in_position = True
                buy_conditions  = False
                sell_conditions = True
                upload_settings('MMM')

        # ______________________________________________________________

    except Exception as e:

        print('Exception-Error >->', e)
        ws.close()                      # <- stop loop

        new_error = Fxt_Error(error=f'Exception-Error >-> {e}')  # <- save to db
        session.add(new_error)
        session.commit()

        time.sleep(300)                 # <- wait 30min
        ws.run_forever()                # <- restart loop
   
########################################################################
########################################################################
   
def on_close(ws):
    print('Socket-Close >->')

def on_error(ws, error):
    print('Socket-Error >->')
    print(error)

    print(datetime.utcnow())

    new_error = Fxt_Error(error=f'Socket-Error >-> {error}')  # <- save to db
    session.add(new_error)
    session.commit()
    
    ws.close() 
    time.sleep(300)
    ws.run_forever()
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


