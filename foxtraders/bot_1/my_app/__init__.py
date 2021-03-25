# ______________________________________________________________________
# Imports
import os, config, websocket, json
import numpy as np, ta_function as ta
from binance.client import Client


# ______________________________________________________________________
# App Configurations

def set_app_config():
    if os.getenv('MY_ENV') == 'home':
        return config.ConfigHome()

    elif os.getenv('MY_ENV') == 'work':
        return config.ConfigWork()
    else:
        return config.ConfigPro()


app = set_app_config()



# ______________________________________________________________________
# Global Variables

my_closes = None
my_timestamps = None
ema_144 = None
sma_36 = None

# ______________________________________________________________________
# Connect to Binance accout



# ______________________________________________________________________
# Retrive Historical Data
client = Client(api_key=app.api_key, api_secret=app.api_secret)
result = client.get_klines(symbol='ADAUSDT', interval=Client.KLINE_INTERVAL_1HOUR)


my_closes = np.array([float(r[4]) for r in result])                     # <- historical closes
my_timestamps = np.array([r[0] for r in result])                        # <- historical timestamps
ema_144 = ta.exp_moving_average_list(my_closes, 144)                    # <- historical 144 emas
sma_36 = ta.simple_moving_avrage_list(my_closes, 36)                    # <- historical 36 smas

print(ema_144[-1], sma_36[-1])
print(my_timestamps[-1], my_closes[-1])
# ______________________________________________________________________
# Binance socket


base_endpoint = "wss://stream.binance.com:9443"
symbol = "adausdt"
kline_length ="1h"

socket_address = f"{base_endpoint}/ws/{symbol}@kline_{kline_length}"

# ____________________________________

def on_open(ws):
    print('Socket-Open')

def on_close(ws):
    print('Socket-Close')

def on_message(ws, message):
    current_tsp = json.loads(message)['k']['t']
    print(current_tsp == my_timestamps[-1])
# ____________________________________

ws = websocket.WebSocketApp(
    socket_address, 
    on_open=on_open, 
    on_close=on_close,
    on_message=on_message
)

ws.run_forever()


