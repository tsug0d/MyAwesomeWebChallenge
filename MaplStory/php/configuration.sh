#!/bin/bash
chmod 777 /var/www/public/upload
chattr +i /var/www/public/upload/index.php
sh /start.sh
