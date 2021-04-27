import os

# ______________________________________________________________________

symbol1         = os.getenv('SYMBOL1')
symbol2         = os.getenv('SYMBOL2')
symbol          = symbol1 + symbol2

restart_time    = int(os.getenv('RESTART_TIME'))

cur_close       = 0
cur_atl         = 0
cur_ath         = 0

cur_timestamp      = ''


p_1 = {
    'name': 'P1',
    'active': True,
    'sell_target': 0,
    'sell_trail': 0.99,
    'target_reached': False,    
    'amount': 1000,
    'sell_price': 0,
    'timestamp': ''
}

p_2 = {
    'name': 'P1',
    'active': True,
    'sell_target': 0,
    'sell_trail': 0.99,
    'target_reached': False,    
    'amount': 1000,
    'sell_price': 0,
    'timestamp': ''
}

p_3 = {
    'name': 'P1',
    'active': True,
    'sell_target': 0,
    'sell_trail': 0.99,
    'target_reached': False,    
    'amount': 1000,
    'sell_price': 0,
    'timestamp': ''
}