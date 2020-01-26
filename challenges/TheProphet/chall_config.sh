#!/bin/bash
echo "Configuring TheProphet..."; docker-compose up -d; 
docker exec -it $(docker ps -aqf "name=theprophet_web") mkdir /phao_san_pa_lay___1337; 
docker exec -it $(docker ps -aqf "name=theprophet_web") touch /phao_san_pa_lay___1337/flagggg.txt;