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

download package from:
https://pypi.org/project/TA-Lib/0.4.19/#modal-close

ta-lib Homepage:
https://github.com/mrjbq7/ta-lib


TA-Lib : Technical Analysis Library
https://ta-lib.org/  


to install:

 ---------------------------------------------------

    Download ta-lib-0.4.0-src.tar.gz from
    https://sourceforge.net/projects/ta-lib/files/ta-lib/0.4.0/ta-lib-0.4.0-src.tar.gz/download?use_mirror=deac-ams
    and:

	on Linux Ubuntu:

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
        

 ---------------------------------------------------

	on Linux Ubuntu (not working try this instead):

	>> https://www.youtube.com/watch?v=AlFSxXP_d9M

        $ tar -xzf ta-lib-0.4.0-src.tar.gz
        $ cd ta-lib/
        $ ./configure 
        $ make
        $ sudo make install

    on Linux 1st install  depandences:
---------------------------------------------------
	or try this:
	https://joelzhang.medium.com/install-ta-lib-in-python-3-7-51219acacafb 

	or
	https://stackoverflow.com/questions/10279829/installing-glib-in-non-standard-prefix-fails
 ---------------------------------------------------

	on windows:
	download .whl file from:

 	https://www.lfd.uci.edu/~gohlke/pythonlibs/#ta-lib

			TA-Lib: a wrapper for the TA-LIB Technical Analysis Library.
			TA_Lib‑0.4.19‑cp39‑cp39‑win_amd64.whl
			TA_Lib‑0.4.19‑cp39‑cp39‑win32.whl
			TA_Lib‑0.4.19‑cp38‑cp38‑win_amd64.whl
			TA_Lib‑0.4.19‑cp38‑cp38‑win32.whl
			TA_Lib‑0.4.19‑cp37‑cp37m‑win_amd64.whl
			TA_Lib‑0.4.19‑cp37‑cp37m‑win32.whl
			TA_Lib‑0.4.19‑cp36‑cp36m‑win_amd64.whl
			TA_Lib‑0.4.19‑cp36‑cp36m‑win32.whl
			TA_Lib‑0.4.17‑cp35‑cp35m‑win_amd64.whl
			TA_Lib‑0.4.17‑cp35‑cp35m‑win32.whl
			TA_Lib‑0.4.17‑cp34‑cp34m‑win_amd64.whl
			TA_Lib‑0.4.17‑cp34‑cp34m‑win32.whl
			TA_Lib‑0.4.17‑cp27‑cp27m‑win_amd64.whl
			TA_Lib‑0.4.17‑cp27‑cp27m‑win32.whl

	One should note that you should download the file keeping your Python version and Windows architecture (32 bit or 64 bit) in mind. E.g. Since we have the python version 3.7 installed and 64 bit Windows 7 system, we will download the file, “TA_Lib‑0.4.17‑cp37‑cp37m‑win_amd64.whl”.

	As you might have guessed “cp37” implies Python version 3.7 and “win_amd64” implies Windows 64 bit operating system.

 mv file in your directory and install will pepenv
	
	>> pipenv install TA_Lib‑0.4.19‑cp37‑cp37m‑win32.whl

check if it works by open python and import talib

<!-- --------------------------------------------------------------- -->

python requirements.txt

python-binance
TA-Lib
numpy


How to keep processes running over SSH without being connected - using GNU screen
https://www.youtube.com/watch?v=3S3I9lT6eKE
https://www.youtube.com/watch?v=I4xVn6Io5Nw
https://nikolak.com/deploying-python-code-to-vps/ 
https://www.digitalocean.com/community/tutorials/how-to-install-and-use-screen-on-an-ubuntu-cloud-server