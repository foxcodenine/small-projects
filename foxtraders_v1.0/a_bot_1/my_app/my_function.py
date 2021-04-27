import os

from my_app import p_1, p_2, p_3, client

from binance.enums import SIDE_BUY, SIDE_SELL, ORDER_TYPE_MARKET
from binance.exceptions import BinanceAPIException

from my_app.database import Fxt_Parameters, Fxt_Current, Fxt_Current, Session
session = Session()


# ______________________________________________________________________



def import_settings(p):
    global p_1, p_2, p_3

    s = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == p).first()

    if   hasattr(s, 'name') and p == 'P1':
        i = p_1
    elif hasattr(s, 'name') and p == 'P2':
        i = p_2
    elif hasattr(s, 'name') and p == 'P3':
        i = p_3
    else:
        i = {}

    i['active'] = bool(int(s.active))

    i['amount'] = float(s.amount)

    i['sell_target'] = round(float(s.sell_target) * (1 + float(s.sell_trail) / 100), 6)    

    i['sell_trail']  = 1 - float(s.sell_trail) / 100


# ______________________________________________________________________



def deactivate(p):
    global p_1, p_2, p_3
    s = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == p).first()

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == p
    ).update({'active': 0}, synchronize_session=False)

    if   hasattr(s, 'name') and p == 'P1':
        p_1['active'] = False
        session.commit()
    elif hasattr(s, 'name') and p == 'P2':
        p_2['active'] = False
        session.commit()
    elif hasattr(s, 'name') and p == 'P3':
        p_3['active'] = False
        session.commit()
    else:
        pass   


def activate(p):
    global p_1, p_2, p_3
    s = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == p).first()

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == p
    ).update({'active': 1}, synchronize_session=False)

    if   hasattr(s, 'name') and p == 'P1':
        p_1['active'] = True
        session.commit()
    elif hasattr(s, 'name') and p == 'P2':
        p_2['active'] = True
        session.commit()
    elif hasattr(s, 'name') and p == 'P3':
        p_3['active'] = True
        session.commit()
    else:
        pass   



# ______________________________________________________________________



def binance_order(action, qty, sym1, sym2, price):

    if os.getenv('MY_ENV') != 'production':
        print('Bot in test mode!')
        return 'Bot in test mode!'
    # __________________________________

    price = float(price)
    qty   = float(qty)
    action = action.lower()
    # __________________________________

    if action == 'buy':
        side = SIDE_BUY
        message =  f'BUY {sym1} {qty} for {sym2} {round(price * qty, 4)}'

    if action == 'sell':
        side = SIDE_SELL
        message = f'SELL {sym1} {qty} for {sym2} {round(price * qty, 4)}'
    
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


