FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY ./investidor_app/news /var/www

RUN chown -R www-data:www-data /var/www

USER www-data

RUN composer clear-cache
RUN composer install --no-dev --optimize-autoloader

RUN php artisan config:clear
RUN php artisan cache:clear

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

EXPOSE 80

COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

CMD service nginx start && php-fpm
