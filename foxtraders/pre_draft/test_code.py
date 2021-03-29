import os
from binance.client import Client

from dotenv import load_dotenv
from pprint import pprint

import math

project_folder = '/home/foxcodenine/Desktop/foxtraders/bot_1'
load_dotenv(os.path.join(project_folder, '.env'), override=True)



# ______________________________________________________________________

# setting the client
client = Client(api_key=os.getenv('API_KEY_BINANCE'), api_secret=os.getenv('API_SECRET_BINANCE'))

# ______________________________________________________________________

def pre_order_check(sym1, sym2):
    symbol = sym1 + sym2
    # get last candle data
    candles = client.get_klines(symbol=symbol.upper(), interval=Client.KLINE_INTERVAL_1HOUR, limit=1)

    # get client asset balance
    balance_sym2 = client.get_asset_balance(asset=sym2)
    

    # helper function
    def round_down(value, decimaplace=0):
        value = float(value)
        factor = 10 ** decimaplace

        return math.floor(value * factor) / factor

    avalable_sym2 = float(balance_sym2['free']) * .99
    sym1_price_in_sym2 = float(candles[-1][4])
    buy_qty_sym1 = round_down(avalable_sym2 / sym1_price_in_sym2, 2)

    print('\n{}'.format(symbol.upper()))
    print(sym2 + ' balance  -> ', balance_sym2['free'])
    print(sym2 + ' avalable -> ', avalable_sym2)
    print(sym1 + ' price    -> ', sym1_price_in_sym2)
    print(f'\nmax of {sym1} you can buy with {sym2} {avalable_sym2} -> ', buy_qty_sym1)

# pre_order_check('ada', 'bnb')
# ______________________________________________________________________


# ______________________________________________________________________
from binance.enums import SIDE_BUY, SIDE_SELL, ORDER_TYPE_MARKET
from binance.exceptions import BinanceAPIException
# ______________________________________________________________________
def binance_order(action, qty, sym1, sym2, cur_close):

    cur_close = float(cur_close)

    if action == 'buy':
        side = SIDE_BUY
        message =  f'BUY {sym1} {qty} for {sym2} {round(cur_close * qty, 2)}'

    if action == 'sell':
        side = SIDE_SELL
        message = f'SELL {sym1} {qty} for {sym2} {round(cur_close * qty, 2)}'
    
    symbol = f'{sym1}{sym2}'.upper()

    try:
        order = client.create_order(
            symbol = symbol,
            side = side,
            type = ORDER_TYPE_MARKET,
            quantity = qty
        )
        
        print('\n',f'Placed {action} order!!') 


        return message

    except BinanceAPIException as e:
        print( f'{action.upper()} ERROR | Binance Error -> {e}')
        return f'{action.upper()} ERROR | Binance Error -> {e}'

# ______________________________________________________________________
candles = client.get_klines(symbol='DOTUSDT', interval=Client.KLINE_INTERVAL_1HOUR, limit=1)
cur_close = float(candles[-1][4])

print(binance_order('sell', 0.5, 'dot', 'usdt', cur_close))












# try:
#     # ooo
#     try: 
#         binance_order(SIDE_SELL, 10, 'btc', 'eur')
#     except BinanceAPIException as e:
#         print('Binance Error ->',e)

# except Exception as e:
#     print('General Error ->', e)
    

# binance_order(SIDE_BUY, .41, 'bnb', 'eur')

# binance_order(SIDE_BUY, .5, 'dot', 'eur')
# binance_order(SIDE_SELL, .5, 'btc', 'eur')

# ______________________________________________________________________

print('\n...so far so good!')