# ______________________________________________________________________
# Imports
import os, websocket, json, time
import numpy as np
from pprint import pprint

from binance.client import Client

# ______________________________________________________________________
# Global Variables

symbol1         = os.getenv('SYMBOL1')
symbol2         = os.getenv('SYMBOL2')
symbol          = symbol1 + symbol2

p_1 = {
    'name': 'P1',
    'active': False,
    'sell_target': 0,
    'target_reached': False,
    'trail': 0.99,
    'amount': 1000,
    'cur_price': 0,
    'cur_atl': 0,
    'cur_ath': 0,
    'sell_price': 0,
    'timestamp': ''
}

p_2 = {
    'name': 'P2',
    'active': False,
    'sell_target': 0,
    'target_reached': False,
    'trail': 0.99,
    'amount': 1000,
    'cur_price': 0,
    'cur_atl': 0,
    'cur_ath': 0,
    'sell_price': 0,
    'timestamp': ''
}

p_3 = {
    'name': 'P3',
    'active': False,
    'sell_target': 0,
    'target_reached': False,
    'trail': 0.99,
    'amount': 1000,
    'cur_price': 0,
    'cur_atl': 0,
    'cur_ath': 0,
    'sell_price': 0,
    'timestamp': ''
}

# ______________________________________________________________________
# Connect Client to Binance account

api_key = os.getenv('API_KEY_BINANCE')
api_secret = os.getenv('API_SECRET_BINANCE')

client = Client(api_key, api_secret)

# ______________________________________________________________________
# Functions

from my_app import my_function as myf

# ______________________________________________________________________
# Database

from my_app.database import Fxt_Settings, Fxt_Current, Fxt_Current, Session
session = Session()

# ______________________________________________________________________
myf.deactivate('P1')


myf.import_settings('P1')
pprint(p_1)

myf.import_settings('P2')
pprint(p_2)

print(os.getenv('MY_ENV'))

print(myf.binance_order('bUy', 1, symbol1, symbol2, 0.0))

