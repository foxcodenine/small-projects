import numpy as np
from sqlalchemy.sql.sqltypes import Float
import my_app.config as cfg 

from my_app.database import Session, Fxt_Action, Fxt_Error, Fxt_Parameters, Fxt_Settings

from my_app import ta_functions as ta

import json, sys

# ______________________________________________________________________

session = Session()

# ______________________________________________________________________

def import_settings():

    cfg.active = bool(int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'active').first().value))
    cfg.symbol1 = session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol1').first().value.upper()
    cfg.symbol2 = session.query(Fxt_Settings).filter(Fxt_Settings.name == 'symbol2').first().value.upper()
    cfg.symbol = cfg.symbol1 + cfg.symbol2
    cfg.restart_time = int(session.query(Fxt_Settings).filter(Fxt_Settings.name == 'restart_time').first().value.upper())

    print('\nUpdate-Settings >->', cfg.symbol)

    session.close()



def import_parameters():
    
    cfg.in_position = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'in_position').first().value))
    cfg.sell_conditions = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sell_conditions').first().value))
    cfg.buy_conditions  = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'buy_conditions').first().value))
    # cfg.target_reached  = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'target_reached').first().value))

    cur_buy_price = (session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'cur_buy_price').first().value)

    if cur_buy_price: cfg.cur_buy_price = float(cur_buy_price)

    cfg.buy_qty = float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'buy_qty').first().value) 
    cfg.sell_qty = float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sell_qty').first().value) 

    cfg.sell_target = 1 + (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sell_target').first().value) / 100)
    cfg.buy_trail   = 1 + (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'buy_trail').first().value) / 100)
    cfg.sell_trail  = 1 - (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sell_trail').first().value) / 100)

    cfg.sma_window = int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'sma_window').first().value)
    cfg.ema_window = int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'ema_window').first().value)
    cfg.ma_type = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'ma_type').first().value
    cfg.ma_offset = 1 + (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'ma_offset').first().value) / 100)

    cfg.msl_on = bool(int(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'msl_on').first().value))
    cfg.msl_per = 1 - (float(session.query(Fxt_Parameters).filter(Fxt_Parameters.name == 'msl_per').first().value) / 100)

    print('\nUpdate-Parameters >->')
    session.close()
    
    if not cfg.sma_window or not cfg.ema_window:
        raise ValueError("ValueError update ema & sma values")



# ______________________________________________________________________


def process_historical_data(results):
    cfg.closes_list = np.array([float(r[4]) for r in results])                   
    cfg.lows_list = np.array([float(r[3]) for r in results])                  
    cfg.highs_list = np.array([float(r[2]) for r in results])  
    cfg.timestamps_list = np.array([r[0] for r in results])


    cfg.ema_list = ta.ema_list(cfg.closes_list, cfg.ema_window)         
    cfg.sma_list = ta.sma_list(cfg.closes_list, cfg.sma_window) 

    cfg.cur_timestamp = cfg.timestamps_list[-1]

    cfg.cur_close = cfg.closes_list[-1]
    cfg.cur_high  = cfg.highs_list[-1]
    cfg.cur_low   = cfg.lows_list[-1]
    
    cfg.cur_ema = cfg.ema_list[-1]
    cfg.cur_sma = cfg.sma_list[-1]

    cfg.cur_atl = cfg.cur_close
    cfg.cur_ath = cfg.cur_close

    print('\nFetch-Historical-Data >->')




def process_message(message):
        message = json.loads(message)
        cfg.cur_timestamp = message['k']['t']
        cfg.cur_close = float(message['k']['c'])
        cfg.cur_low   = float(message['k']['l'])
        cfg.cur_high  = float(message['k']['h'])
        
# ______________________________________________________________________

def print_current():
    message = f'\n PRICE: {cfg.cur_close}, ATL: {cfg.cur_atl}, ATH: {cfg.cur_ath}'
    print(message)
    
    def rd(v, dp=4):
        return round(v, dp)

    if cfg.in_position:
        print(f'in_pos|sell_conditions {cfg.sell_conditions} TG: {rd(cfg.sell_target * cfg.cur_buy_price)}')

    if not cfg.in_position:
        print(f'not_in_pos|buy_conditions {cfg.buy_conditions} {cfg.ma_type}: {rd(cfg.cur_ma)}')

# ______________________________________________________________________

def ma_current():
    
    if cfg.ma_type.upper() == 'EMA':
        cfg.cur_ma = cfg.cur_ema * cfg.ma_offset
    elif cfg.ma_type.upper() == 'SMA':
        cfg.cur_ma = cfg.cur_sma * cfg.ma_offset
    else:
        raise ValueError("ValueError moving averages type")

# ______________________________________________________________________

def log_parameters():

    # cfg.in_position = not cfg.in_position
    # cfg.sell_conditions = not cfg.sell_conditions
    # cfg.buy_conditions = not cfg.buy_conditions
    # cfg.target_reached = not cfg.target_reached
    # cfg.cur_buy_price = cfg.cur_close

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == 'in_position'
    ).update({'value': int(cfg.in_position)}, synchronize_session=False)

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == 'sell_conditions'
    ).update({'value': int(cfg.sell_conditions)}, synchronize_session=False)

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == 'buy_conditions'
    ).update({'value': int(cfg.buy_conditions)}, synchronize_session=False)

    # session.query(Fxt_Parameters).filter(
    #     Fxt_Parameters.name == 'target_reached'
    # ).update({'value': int(cfg.target_reached)}, synchronize_session=False)

    if cfg.cur_buy_price :
        value = float(cfg.cur_buy_price)
    else:
        value = None
        
    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == 'cur_buy_price'
    ).update({'value': value}, synchronize_session=False)

    session.commit()

# ______________________________________________________________________

def log_action(action):
    
    new_action = Fxt_Action( price=cfg.cur_close, action=action)    
    session.add(new_action)
    session.commit()
    

# ______________________________________________________________________




def binance_order(action):
    # __________________________________
    try:

        if os.getenv('MY_ENV') != 'production':

            message = 'Bot in {} test mode!'.format(action)
            print(message)
            return message 
    # __________________________________

        sym1  = cfg.symbol1
        sym2  = cfg.symbol2
        symbol = f'{sym1}{sym2}'.upper()

        price = float(cfg.cur_close)    
        action = action.lower()
    
    # # __________________________________

        if action == 'buy':
            qty  = float(cfg.buy_qty)
            side = SIDE_BUY
            message =  f'BUY ORDER {sym1} {qty} for {sym2} {round(price * qty, 4)}'

        if action == 'sell':
            qty  = float(cfg.sell_qty)
            side = SIDE_SELL
            message = f'SELL ORDER {sym1} {qty} for {sym2} {round(price * qty, 4)}'
    
    # # __________________________________
    
        order = client.create_order(
            symbol = symbol,
            side = side,
            type = ORDER_TYPE_MARKET,
            quantity = qty
        ) 
        
    # # __________________________________

        pprice = 0
        qqty = 0

        for f in order['fills']:
            pprice += float(f['price'])
            qqty += float(f['qty'])

        pprice = pprice / len(order['fills'])

        if action == 'buy':
            message =  f'BUY ORDER {sym1} {qqty} for {sym2} {round(pprice * qqty, 4)}'
            cfg.cur_buy_price = pprice

        if action == 'sell':
            message = f'SELL ORDER {sym1} {qqty} for {sym2} {round(pprice * qqty, 4)}'
            cfg.cur_buy_price = None
        # ______________________________________________________________

        print('\n', message) 
        return message

    except BinanceAPIException as e:        

        message = f'{action.upper()} ERROR | BINANCE ERROR -> {e}'
        log_action(action=message)

        print('Binance API Exception >->')
        print(message)
        sys.exit(message)