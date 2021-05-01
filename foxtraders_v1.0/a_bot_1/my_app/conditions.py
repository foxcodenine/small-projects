
from datetime import datetime

from my_app.app import p_1, p_2, p_3, p_4, p_5
from my_app.app import cur_close, cur_ath, cur_atl
from my_app.app import app_mode, symbol1, symbol2
from my_app import my_function as myf

from my_app.app import import_settings

# ______________________________________________________________________



def conditions_function(position, close, ath, atl, app_mode):

    if app_mode == 'sell':    
        if position.active:
            sell_function(position, close,  ath, app_mode)

    if app_mode == 'buy':
        if position.active:
            buy_function(position, close, atl, app_mode)

# ______________________________________________________________________

def buy_function(position, close,  ath, app_mode):
    global p_1, p_2, p_4, p_5

    name   = position.name
    target = position.buy_target
    trail  = position.buy_trail
    dt = datetime.utcnow().strftime('%c')
    amount = position.amount

    

    if close <= target and not position.target_reached:

        myf.target_reached(position)
        message =  f'{name} Target Reached. Price {close}. {dt}'
        
        print(message)
        myf.log_action(message)


    print('...', name, position.target_reached, '>', target)

    if position.target_reached and  close > ath * trail:


        myf.deactivate(position)   

        message =  f'{name} Closed. Price {close}. {dt}'        
        print(message)
        myf.log_action(message)

        message = myf.binance_order(app_mode, amount, symbol1, symbol2, cur_close)
        print(message)
        myf.log_action(message)    
    
# ______________________________________________________________________


def sell_function(position, close,  ath, app_mode):
    global p_1, p_2, p_4, p_5

    name   = position.name
    target = position.sell_target
    trail  = position.sell_trail
    dt = datetime.utcnow().strftime('%c')
    amount = position.amount


    if close >= target and not position.target_reached:

        myf.target_reached(position)
        message =  f'{name} Target Reached. Price {close}. {dt}'
        
        print(message)
        myf.log_action(message)


    print('...', name, position.target_reached, '>', target)

    if position.target_reached and  close < ath * trail:


        myf.deactivate(position)   

        message =  f'{name} Closed. Price {close}. {dt}'        
        print(message)
        myf.log_action(message)

        message = myf.binance_order(app_mode, amount, symbol1, symbol2, cur_close)
        print(message)
        myf.log_action(message)    
    
# ______________________________________________________________________