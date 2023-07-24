FROM php:8.1-fpm

WORKDIR /var/www/html/

RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y git


# RUN chown -R www-data:www-data /var/www/html/projeto2/storage
# RUN chown -R www-data:www-data /var/www/html/projeto2/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
