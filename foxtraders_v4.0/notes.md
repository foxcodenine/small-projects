
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

	[
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
	]

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


<!-- --------------------------------------------------------------- -->
hostname : ubuntu-s-1vcpu-2gb-intel-fra1-01
ipv4 : 167.172.163.199

<!-- --------------------------------------------------------------- -->
How to Connect to your Droplet with OpenSSH

ssh root@167.172.163.199 

or 

ssh -i /home/foxcodenine/digitalocean/digitalOcean.txt root@167.172.163.199
ssh -i /g/digitalocean/digitalOcean.txt root@167.172.163.199

<!-- --------------------------------------------------------------- -->
bot_1
$ sudo scp -i /home/foxcodenine/digitalocean/digitalOcean.txt -r /home/foxcodenine/Desktop/foxtraders_v4/bot_1/my_app/__init__.py root@167.172.163.199:/home/foxtraders/bot_1/my_app




https://linuxize.com/post/how-to-use-linux-screen/

Starting Named Session
$ screen -S bot_2

Rename screen session
$ screen -S 8890.foo -X sessionname bar

Detach from a screen
Ctrl+a Ctrl+d

Resume a screen
$ screen -r 30608

Resume screen, says I am already attached
$ screen -r -d 30608

Kill detached screen session [closed]
$ screen -X -S 30608 quit


<!-- --------------------------------------------------------------- -->

### MySql

Show all users
mysql> SELECT User,Host FROM mysql.user;

Create new user
mysql> CREATE USER s****m**@localhost IDENTIFIED BY '***_and_****_**';
mysql> CREATE USER s****m**@localhost IDENTIFIED BY '***_&_****_**';
mysql> CREATE USER man****@localhost IDENTIFIED BY '**_R**';

To Grant permissions to a user.
mysql> GRANT ALL PRIVILEGES ON * . * TO man****@localhost;

<!-- -------------- -->
Delete user
mysql> DROP USER superman@localhost;

To update host:
mysql> UPDATE mysql.user SET host="localhost" WHERE user="admin";

<!-- --------------------------------------------------------------- -->

SELECT * FROM fxt_data;
SHOW TABLES;
DROP TABLE fxt_data;
DROP TABLE fxt_data; DROP TABLE fxt_error; DROP TABLE fxt_action;

delete from fxt_action where ID between 10 and 266;


ALTER TABLE fxt_data 
RENAME COLUMN ema144 TO ema;
ALTER TABLE fxt_data 
RENAME COLUMN sma36 TO sma;


<!-- --------------------------------------------------------------- -->

### How to Check your Ubuntu Version

    0. Open Terminal
        Ctrl+Alt+T

    1. Use the lsb_release -a
        $ lsb_release -a

    2. Check Ubuntu version using the /etc/os-release file
        $ cat /etc/os-release

    3. Check Ubuntu version using the hostnamectl command 
        $ hostnamectl

<!-- --------------------------------------------------------------- -->
