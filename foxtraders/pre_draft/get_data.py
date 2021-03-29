import os, csv

from binance.client import Client


client = Client(api_key=os.getenv('API_KEY'), api_secret=os.getenv('API_SECRET'))

# ______________________________________________________________________

# prices = client.get_all_tickers()

# for p in prices:
#     print(p)

# ______________________________________________________________________

candles = client.get_klines(symbol='ADAUSDT', interval=Client.KLINE_INTERVAL_1HOUR)


# ___________________________

csvfile = open('adausdt60minutes.csv', 'w', newline='')
candlestick_writer = csv.writer(csvfile, delimiter=',')

# ___________________________


for c in candles:
    print(c)
    candlestick_writer.writerow(c)

print('Length ->', len(candles))

# ______________________________________________________________________
'''
    [
        1499040000000,      # Open time
        "0.01634790",       # Open
        "0.80000000",       # High
        "0.01575800",       # Low
        "0.01577100",       # Close
        "148976.11427815",  # Volume
        1499644799999,      # Close time
        "2434.19055334",    # Quote asset volume
        308,                # Number of trades
        "1756.87402397",    # Taker buy base asset volume
        "28.46694368",      # Taker buy quote asset volume
        "17928899.62484339" # Can be ignored
    ]
'''

# ______________________________________________________________________