FROM php:7.4-fpm-alpine3.14

RUN apk add --no-cache openssl bash nodejs npm postgresql-dev
RUN docker-php-ext-install bcmath pdo pdo_pgsql

# # Install GD
# RUN apk add --no-cache freetype-dev libjpeg-turbo-dev libpng-dev libzip-dev zlib-dev
# RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
# RUN docker-php-ext-install gd

# # Install ZIP
# RUN apk add --no-cache zip
# RUN docker-php-ext-install zip

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s puplic html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

RUN chmod -R 777 /var/www/storage

EXPOSE 9000

ENTRYPOINT ["php-fpm"]

#docker-compose exec listashop bash
