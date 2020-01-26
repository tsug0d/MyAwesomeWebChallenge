FROM antonienko/nginx-php-fpm
COPY ./src/www/public /var/www/public
ADD configuration.sh /tmp/configuration.sh
RUN chmod 777 /tmp/configuration.sh
CMD /tmp/configuration.sh
