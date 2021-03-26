
<!-- --------------------------------------------------------------- -->
    $ sudo pipenv install -r requirements.txt

        numpy
        python-dotenv
        python-binance
        websocket_client


        sqlalchemy
        pymysql

<!-- --------------------------------------------------------------- -->

### python-binance
https://python-binance.readthedocs.io/en/latest/
https://github.com/binance-exchange
https://github.com/binance/binance-spot-api-docs

Web Socket Streams for Binance (2019-11-13)
https://github.com/binance/binance-spot-api-docs/blob/master/web-socket-streams.md

        Kline/Candlestick Streams
                {
                "e": "kline",     // Event type
                "E": 123456789,   // Event time
                "s": "BNBBTC",    // Symbol
                "k": {
                    "t": 123400000, // Kline start time
                    "T": 123460000, // Kline close time
                    "s": "BNBBTC",  // Symbol
                    "i": "1m",      // Interval
                    "f": 100,       // First trade ID
                    "L": 200,       // Last trade ID
                    "o": "0.0010",  // Open price
                    "c": "0.0020",  // Close price
                    "h": "0.0025",  // High price
                    "l": "0.0015",  // Low price
                    "v": "1000",    // Base asset volume
                    "n": 100,       // Number of trades
                    "x": false,     // Is this kline closed?
                    "q": "1.0000",  // Quote asset volume
                    "V": "500",     // Taker buy base asset volume
                    "Q": "0.500",   // Taker buy quote asset volume
                    "B": "123456"   // Ignore
                }
                }