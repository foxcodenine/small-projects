import os

# ______________________________________________________________________

app_mode        = os.getenv('MODE').lower()

symbol1         = os.getenv('SYMBOL1')
symbol2         = os.getenv('SYMBOL2')
symbol          = symbol1 + symbol2

restart_time    = int(os.getenv('RESTART_TIME'))

cur_close       = 0
cur_atl         = None
cur_ath         = None

cur_timestamp      = ''


p_1 = {
    'name': 'P1',
    'active': True,
    'amount': 1000,

    'sell_target': 0,
    'sell_trail': 0.99,

    'buy_target': 0,
    'buy_trail': 0.99,

    'target_reached': False,    
    
    'sell_price': 0,
    'buy_price': 0,

    'timestamp': ''
}

p_2 = {
    'name': 'P2',
    'active': True,
    'amount': 1000,

    'sell_target': 0,
    'sell_trail': 0.99,

    'buy_target': 0,
    'buy_trail': 0.99,

    'target_reached': False,    
    
    'sell_price': 0,
    'buy_price': 0,

    'timestamp': ''
}

p_3 = {
    'name': 'P3',
    'active': True,
    'amount': 1000,

    'sell_target': 0,
    'sell_trail': 0.99,

    'buy_target': 0,
    'buy_trail': 0.99,

    'target_reached': False,    
    
    'sell_price': 0,
    'buy_price': 0,

    'timestamp': ''
}


