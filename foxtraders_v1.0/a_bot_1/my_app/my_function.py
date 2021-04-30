import os

from my_app import p_1, p_2, p_3, client
from my_app import app_mode, symbol1, symbol2, symbol, restart_time

from binance.enums import SIDE_BUY, SIDE_SELL, ORDER_TYPE_MARKET
from binance.exceptions import BinanceAPIException

from my_app.database import Fxt_Parameters, Fxt_Action, Session
session = Session()


# ______________________________________________________________________

def import_parameters(p):
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

    i['buy_target'] = round(float(s.buy_target) * (1 - float(s.sell_trail) / 100), 6) 

    i['buy_trail']  = 1 + float(s.buy_trail) / 100

    i['target_reached'] = bool(int(s.target_reached))

# ______________________________________________________________________


# def import_settings():
#     # global app_mode, symbol1, symbol2, symbol, restart_time

#     app_mode = session.query(Fxt_Settings).filter(Fxt_Settings.name == mode).first().value
#     symbol1 = session.query(Fxt_Settings).filter(Fxt_Settings.name == symbol1).first().value.upper()
#     symbol2 = session.query(Fxt_Settings).filter(Fxt_Settings.name == symbol2).first().value.upper()
#     symbol = symbol1 + symbol2

#     pass

# ______________________________________________________________________


def deactivate(p):
    global p_1, p_2, p_3
    p = p['name']
    
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

# ______________________________________________________________________

def activate(p):
    global p_1, p_2, p_3
    p = p['name']

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

def target_reached(p):
    global p_1, p_2, p_3
    p = p['name']

    s = session.query(Fxt_Parameters).filter(Fxt_Parameters.name == p).first()    

    session.query(Fxt_Parameters).filter(
        Fxt_Parameters.name == p
    ).update({'target_reached': 1}, synchronize_session=False)

    if   hasattr(s, 'name') and p == 'P1':
        print(1)
        p_1['target_reached'] = True
        session.commit()
    elif hasattr(s, 'name') and p == 'P2':
        print(2)
        p_2['target_reached'] = True
        session.commit()
    elif hasattr(s, 'name') and p == 'P3':
        print(2)
        p_3['target_reached'] = True
        session.commit()
    else:
        print('pass') 
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



