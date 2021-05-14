from datetime import datetime

from my_app import my_function as myf

from my_app.app import import_settings, deactivate, target_reached_update

# ______________________________________________________________________



def conditions_function(position, close, ath, atl, app_mode, symbol1, symbol2):
    
    if app_mode.lower() == 'sell':       
        if position.active:
            sell_function(position, close,  ath, app_mode, symbol1, symbol2)

    if app_mode.lower() == 'buy':
        if position.active:
            buy_function(position, close, atl, app_mode, symbol1, symbol2)

# ______________________________________________________________________

def buy_function(position, close,  ath, app_mode, symbol1, symbol2):

    name   = position.name
    target = position.buy_target
    trail  = position.buy_trail    
    amount = position.amount
    co = position.counterorder
    

    if close <= target and not position.target_reached:

        dt = datetime.utcnow().strftime('%c')

        target_reached_update(position)
        message =  f'{name} Target Reached. Price {close}. {dt}'
        
        print(message)
        myf.log_action(message)


    print('...', name, position.target_reached, '>', target)

    if position.target_reached and  close > ath * trail:

        dt = datetime.utcnow().strftime('%c')

        deactivate(position)   

        message =  f'{name} Closed. Price {close}. {dt}'        
        print(message)
        myf.log_action(message)

        message = myf.binance_order(app_mode, amount, symbol1, symbol2, close, co)
        print(message)
        myf.log_action(message)    
    
# ______________________________________________________________________


def sell_function(position, close,  ath, app_mode, symbol1, symbol2):

    name   = position.name
    target = position.sell_target
    trail  = position.sell_trail
    dt = datetime.utcnow().strftime('%c')
    amount = position.amount
    co = position.counterorder


    if close >= target and not position.target_reached:

        target_reached_update(position)
        message =  f'{name} Target Reached. Price {close}. {dt}'
        
        print(message)
        myf.log_action(message)


    print('...', name, position.target_reached, '>', target)

    if position.target_reached and  close < ath * trail:


        deactivate(position)   

        message =  f'{name} Closed. Price {close}. {dt}'        
        print(message)
        myf.log_action(message)

        message = myf.binance_order(app_mode, amount, symbol1, symbol2, close, co)
        print(message)
        myf.log_action(message)    
    
# ______________________________________________________________________