#!/bin/bash

php /home/lucas/Documents/PA-BOTNET-WEB/botnet-web migrate
php /home/lucas/Documents/PA-BOTNET-WEB/botnet-web db:seed
php /home/lucas/Documents/PA-BOTNET-WEB/botnet-web/artisan serv --host 0.0.0.0 --port 8080

