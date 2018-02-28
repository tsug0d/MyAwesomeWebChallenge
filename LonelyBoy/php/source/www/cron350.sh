#!/bin/bash
sleep 100
while :
do
    sleep 1
    php /var/www/cron.php || break
done


