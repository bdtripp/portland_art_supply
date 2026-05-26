FROM php:8.4-apache
RUN rm -f /var/www/html/index.html
RUN apt-get update \
    && apt-get install -y curl \
    && docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite
COPY public/ /var/www/html/
COPY src/ /var/www/src/
COPY vendor/ /var/www/vendor/
COPY config.php /var/www/config.php
EXPOSE 80