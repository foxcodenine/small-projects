https://www.youtube.com/watch?v=d-2GoqQbagI&list=PLvzuUVysUFOuB1kJQ3S2G-nB7_nHhD7Ay&index=2


binance-exchange 
https://github.com/binance-exchange
https://github.com/binance-exchange/binance-official-api-docs


web-socket-streams.md 
https://github.com/binance/binance-spot-api-docs/blob/master/web-socket-streams.md

The base endpoint is: wss://stream.binance.com:9443

ADAUSDT
wss://stream.binance.com:9443/ws/adausdt@kline_1h


<!-- --------------------------------------------------------------- -->

### wscat
https://www.npmjs.com/package/wscat

This module needs to be installed globally so use the -g flag when installing:

    $ sudo npm install -g wscat

    $ wscat -c wss://stream.binance.com:9443/ws/adausdt@kline_1h | tee adausdt.txt


<!-- --------------------------------------------------------------- -->

### PM2
How to npm run start at the background
https://medium.com/idomongodb/how-to-npm-run-start-at-the-background-%EF%B8%8F-64ddda7c1f1

    $ sudo npm install pm2 -g
<!-- --------------------------------------------------------------- -->


### Writing WebSocket client applications

https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API/Writing_WebSocket_client_applications



### lightweight-charts

    https://github.com/tradingview/lightweight-charts/tree/master/docs

    $ npm install lightweight-charts --save

    or
    
    cdn
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>

    For candlestick:
    https://github.com/tradingview/lightweight-charts/blob/master/docs/candlestick-series.md
    
    
    
    
<!-- --------------------------------------------------------------- -->


### python-binance
    https://python-binance.readthedocs.io/en/latest/
    
    $ pipenv install python-binance

Binance API

    https://python-binance.readthedocs.io/en/latest/binance.html#binance.client.Client.get_klines

<!-- --------------------------------------------------------------- -->

### ta-lib python

https://github.com/mrjbq7/ta-lib


TA-Lib : Technical Analysis Library
https://ta-lib.org/


to install:

    on Linux 1st install  depandences:

    Download ta-lib-0.4.0-src.tar.gz from
    https://sourceforge.net/projects/ta-lib/files/ta-lib/0.4.0/ta-lib-0.4.0-src.tar.gz/download?use_mirror=deac-ams
    and:

        $ tar -xzf ta-lib-0.4.0-src.tar.gz
        $ cd ta-lib/
        $ ./configure --prefix=/usr
        $ make
        $ sudo make install

    then install pacage:

        $ sudo pipenv install TA-Lib


    to test it open python and import talib:

        $ pipen run python
        import talib

    install numpy:
        $ sudo pipenv install numpy
        

    (video 3min)
<!-- --------------------------------------------------------------- -->

python requirements.txt

python-binance
TA-Lib
numpy