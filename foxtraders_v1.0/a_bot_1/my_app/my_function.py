import os

from my_app.app import p_1, p_2, p_3, p_4, p_5, client
from my_app.app import app_mode, symbol1, symbol2, symbol, restart_time

from binance.enums import SIDE_BUY, SIDE_SELL, ORDER_TYPE_MARKET
from binance.exceptions import BinanceAPIException

from my_app.database import Fxt_Parameters, Fxt_Action, Fxt_Error, Fxt_Settings, Session
session = Session()

# ______________________________________________________________________


def deactivate(p):
    global p_1, p_2, p_3, p_4, p_5
    
    
    s = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == p.name).first()

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == p.name
    ).update({'active': 0}, synchronize_session=False)

    if   hasattr(s, 'name') and p.name == s.name:
        p.active = False
        session.commit()


# ______________________________________________________________________

def activate(p):
    global p_1, p_2, p_3, p_4, p_5
    

    s = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == p.name).first()

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == p.name
    ).update({'active': 1}, synchronize_session=False)

    if   hasattr(s, 'name') and p.name == s.name:
        p.active = True
        session.commit()
 

# ______________________________________________________________________

def target_reached(p):
    global p_1, p_2, p_3, p_4, p_5
    

    s = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == p.name).first()    

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == p.name
    ).update({'target_reached': 1}, synchronize_session=False)

    if   hasattr(s, 'name') and p.name == s.name:
        p.target_reached = True
        session.commit()

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

        qty   = qty / price

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





