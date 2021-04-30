from my_app import my_function as myf
from datetime import datetime

from my_app import p_1, p_2, p_3
from my_app import cur_close, cur_ath, cur_atl
from my_app import app_mode, symbol1, symbol2

# ______________________________________________________________________


def selling(position, close,  ath):
    
    if position['active']:
        selling_position(position, close,  ath)

# ______________________________________________________________________

def selling_position(position, close,  ath):
    global p_1, p_2, p_3

    name   = position['name']
    target = position['sell_target']
    trail  = position['sell_trail']
    dt = datetime.utcnow().strftime('%c')
    amount = position['amount']


    if close >= target and not position['target_reached']:

        myf.target_reached(position)
        message =  f'{name} Target Reached. Price {close}. {dt}'
        
        print(message)
        myf.log_action(message)


    if position['target_reached'] and  close < ath * trail:

        myf.deactivate(position)   

        message =  f'{name} Closed. Price {close}. {dt}'        
        print(message)
        myf.log_action(message)

        message = myf.binance_order(app_mode, amount, symbol1, symbol2, cur_close)
        print(message)
        myf.log_action(message)

    print('...', name, position['target_reached'])
    
# ______________________________________________________________________
