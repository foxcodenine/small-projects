import os
import pprint

from binance.enums import SIDE_BUY, SIDE_SELL, ORDER_TYPE_MARKET, ORDER_TYPE_LIMIT, TIME_IN_FORCE_GTC
from binance.exceptions import BinanceAPIException

from my_app.app import client

from my_app.database import Fxt_Parameters, Fxt_Action, Fxt_Error, Fxt_Settings, Session
session = Session()



# ______________________________________________________________________

def binance_order(action, qty, sym1, sym2, price, counterorder):

    if os.getenv('MY_ENV') != 'production':

        message = 'Bot in {} test mode!'.format(action)
        print(message)
        return message 
    # __________________________________

    price = float(price)
    qty   = float(qty)
    action = action.lower()
    
    # __________________________________

    if action == 'buy':
        qty   = round(qty / price, 2)
        side = SIDE_BUY
        message =  f'BUY ORDER {sym1} {qty} for {sym2} {round(price * qty, 4)}'

    if action == 'sell':
        side = SIDE_SELL
        message = f'SELL ORDER {sym1} {qty} for {sym2} {round(price * qty, 4)}'
    
    symbol = f'{sym1}{sym2}'.upper()


    
    # __________________________________
    try:
        order = client.create_order(
            symbol = symbol,
            side = side,
            type = ORDER_TYPE_MARKET,
            quantity = qty
        ) 

        print('\n',order['fills']) 

        # ______________________________________________________________
        if counterorder:
            
            pprice = 0
            qqty = 0

            for f in order['fills']:
                pprice += float(f['price'])
                qqty += float(f['qty'])

            pprice = pprice / len(order['fills'])

            if action == 'sell':
                base_crypto = qqty * pprice
                side = SIDE_BUY
                pprice = round(pprice * 0.75, 4)
                qqty = round(base_crypto / pprice * 0.99, 2)

            else:
                side = SIDE_SELL
                pprice = round(pprice * 1.25, 4)                  
                              

            counter_order = client.create_order(
                symbol=symbol,
                side = side,
                type = ORDER_TYPE_LIMIT,
                quantity = qqty,
                price = pprice,
                timeInForce=TIME_IN_FORCE_GTC, 
            )   
                
            print('\n', counter_order) 
        # ______________________________________________________________

        print('\n', message) 
        return message
    # __________________________________

    except BinanceAPIException as e:
        print('Binance API Exception >->')

        message = f'{action.upper()} ERROR | BINANCE ERROR -> {e}'

        print(message)
        return message

# ______________________________________________________________________

def log_action(message):
        new_action = Fxt_Action(action=message)
        session.add(new_action)
        session.commit()
# ______________________________________________________________________








