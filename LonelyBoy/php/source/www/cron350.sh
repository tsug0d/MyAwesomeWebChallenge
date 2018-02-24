#!/bin/bash
sleep 2000
while :
do
    sleep 1
    php /var/www/cron.php || break
done


