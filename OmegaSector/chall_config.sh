#!/bin/bash
echo "configuring OmegaSector..."
docker-compose up -d
wait $(pgrep docker-compose)
docker exec -it $(docker ps -aqf "name=omegasector_php") chmod 777 /var/www/html/alien_message
docker exec -it $(docker ps -aqf "name=omegasector_php") chmod 777 /var/www/html/human_message