FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    bash \
    libpng-dev \
    libjpeg-turbo8-dev \
    libwebp-dev \
    libxpm-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    icu-devtools \
    libmemcached-dev \
    nginx \
    git \
    curl \
    php8.1-fpm \
    php8.1-cli \
    php8.1-mbstring \
    php8.1-xml \
    php8.1-zip \
    php8.1-curl \
    php8.1-mysql \
    php8.1-intl \
    php8.1-opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

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
