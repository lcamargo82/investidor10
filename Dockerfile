FROM php:8.2-fpm

RUN apk add --no-cache \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    zlib-dev \
    libxml2-dev \
    libzip-dev \
    icu-dev \
    libmemcached-dev \
    nginx \
    git \
    curl \
    && docker-php-ext-configure zip \
    && docker-php-ext-install gd zip pdo pdo_mysql intl opcache \
    && apk del icu-dev \
    && rm -rf /var/cache/apk/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY ./investidor_app/news /var/www

RUN composer install --no-dev --optimize-autoloader

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

RUN chown -R www-data:www-data /var/www

USER www-data

EXPOSE 80

CMD service nginx start && php-fpm

# FROM php:8.2-fpm

# RUN apt-get update && apt-get install -y \
#     zip \
#     unzip \
#     git \
#     curl \
#     libfreetype6-dev \
#     libjpeg62-turbo-dev \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     mariadb-client \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring xml

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www

# COPY ./investidor_app/news /var/www

# RUN chown -R www-data:www-data /var/www \
#     && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# RUN composer install --no-dev --optimize-autoloader

# COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
# RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# EXPOSE 80 9000 8000

# CMD ["php-fpm", "-F"]

# ENTRYPOINT ["docker-entrypoint.sh"]
