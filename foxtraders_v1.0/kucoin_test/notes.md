### Installation
pip install python-kucoin

### Initialise the client
from kucoin.client import Client
client = Client(api_key, api_secret, api_passphrase)

<!-- --------------------------------------------------------------- -->

### Market Endpoints  -  get_kline_data
https://python-kucoin.readthedocs.io/en/latest/market.html

    klines = client.get_kline_data('KCS-BTC', '5min', 1507479171, 1510278278)
    Returns:	ApiResponse
    [
        [
            "1545904980",             //Start time of the candle cycle
            "0.058",                  //opening price
            "0.049",                  //closing price
            "0.058",                  //highest price
            "0.049",                  //lowest price
            "0.018",                  //Transaction amount
            "0.000945"                //Transaction volume
        ],
        [
            "1545904920",
            "0.058",
            "0.072",
            "0.072",
            "0.058",
            "0.103",
            "0.006986"
        ]
    ]

<!-- --------------------------------------------------------------- -->