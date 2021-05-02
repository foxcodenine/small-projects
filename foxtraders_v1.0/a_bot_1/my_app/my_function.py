import os

from binance.enums import SIDE_BUY, SIDE_SELL, ORDER_TYPE_MARKET
from binance.exceptions import BinanceAPIException

from my_app.app import client

from my_app.database import Fxt_Parameters, Fxt_Action, Fxt_Error, Fxt_Settings, Session
session = Session()



# ______________________________________________________________________

def binance_order(action, qty, sym1, sym2, price):

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
        print(message) 
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





