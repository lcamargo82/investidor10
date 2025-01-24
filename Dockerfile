FROM php:8.2-fpm

# Instalar dependências do sistema e PHP
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

# Copiar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar o código da aplicação
COPY ./investidor_app/news /var/www

# Instalar as dependências do Laravel com o Composer
RUN composer install --no-dev --optimize-autoloader

# Copiar configurações do Xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Copiar configuração do Nginx
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Ajustar permissões de diretório
RUN chown -R www-data:www-data /var/www

# Garantir que o PHP-FPM e o Nginx usem o usuário adequado
USER www-data

# Expor a porta 80
EXPOSE 80

# Iniciar o PHP-FPM e o Nginx
CMD nginx -g 'daemon off;' && php-fpm


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
