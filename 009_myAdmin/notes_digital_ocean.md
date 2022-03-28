## ------ Check for currently used DNS server IP address ---------------

    $ ip r

## ------ Installing Apache --------------------------------------------

    $ sudo apt install apache2

## ------ PHP ----------------------------------------------------------

    $ sudo apt install software-properties-common

    $ sudo add-apt-repository ppa:ondrej/php

    $ sudo apt install php8.0 libapache2-mod-php8.0

    $ sudo systemctl restart apache2

    $ sudo apt install php8.0-mysql php8.0-gd

## ------  Apache Enabling Sites and Modules ---------------------------



    $ sudo a2ensite foxcode.codes.conf


    $ sudo systemctl reload apache2

    $ sudo a2enmod rewrite


## ------  scp ---------------------------------------------------------

    $ sudo scp -i ~/digitalocean/digitalOcean.txt -r /var/www/projects/test.123 username@###.###.###.###:/home/username/projects



## ------  enabling encrypted HTTPS ------------------------------------

Step 1 — Installing Certbot:

    $ sudo apt install certbot python3-certbot-apache


Step 2 — Checking your Apache Virtual Host Configuration:

    $ sudo apache2ctl configtest
    $ sudo systemctl reload apache2

Step 3 — Allowing HTTPS Through the Firewall

    ?? need to work on it

    https://www.digitalocean.com/community/tutorials/how-to-set-up-a-firewall-with-ufw-on-ubuntu-20-04
    https://www.digitalocean.com/community/tutorials/how-to-secure-apache-with-let-s-encrypt-on-ubuntu-20-04

Step 4 — Obtaining an SSL Certificate:

    $ sudo certbot --apache

Step 5 — Verifying Certbot Auto-Renewal

    $ sudo systemctl status certbot.timer

    $ sudo certbot renew --dry-run