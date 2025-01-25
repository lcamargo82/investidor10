# Etapa 1: Construção do ambiente
FROM php:8.2-fpm AS builder

# Instalar dependências básicas e extensões necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    curl \
    libpng-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar os arquivos do Laravel para o container
COPY ./investidor_app/news /var/www

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configurar permissões para o diretório /var/www
RUN chown -R www-data:www-data /var/www

# Gerar cache de configuração e otimizações
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan cache:clear

# Etapa 2: Configuração do servidor de produção
FROM php:8.2-fpm

# Instalar Nginx
RUN apt-get update && apt-get install -y nginx

# Copiar configuração do Nginx
COPY ./nginx/nginx.conf /etc/nginx/sites-available/default

# Copiar arquivos da aplicação do builder
COPY --from=builder /var/www /var/www

RUN chown -R www-data:www-data /var/www

# Gerar cache de configuração e otimizações
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan cache:clear

# Configurar open_basedir para permitir acesso aos diretórios necessários
RUN echo "php_admin_value[open_basedir] = /var/www:/tmp" >> /usr/local/etc/php-fpm.d/www.conf

# Expor a porta HTTP esperada pelo Render
EXPOSE 8080

# Comando para iniciar o Nginx e o PHP-FPM juntos
CMD ["sh", "-c", "service nginx start && php-fpm -F"]



# # Etapa 1: Construção do ambiente -- esse deu certo
# FROM php:8.2-fpm AS builder

# # Instalar dependências básicas e extensões necessárias
# RUN apt-get update && apt-get install -y \
#     git \
#     unzip \
#     libzip-dev \
#     libonig-dev \
#     curl \
#     libpng-dev \
#     libpq-dev \
#     && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# # Instalar Composer
# COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# # Definir diretório de trabalho
# WORKDIR /var/www

# # Copiar os arquivos do Laravel para o container
# COPY ./investidor_app/news /var/www

# # Instalar dependências do Laravel
# RUN composer install --no-dev --optimize-autoloader

# # Configurar permissões
# RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# # Gerar cache de configuração e otimizações
# RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# # Etapa 2: Configuração do servidor de produção
# FROM php:8.2-fpm

# # Instalar Nginx
# RUN apt-get update && apt-get install -y nginx

# # Copiar configuração do Nginx
# COPY ./nginx/nginx.conf /etc/nginx/sites-available/default

# # Copiar arquivos da aplicação do builder
# COPY --from=builder /var/www /var/www

# # Configurar diretório de trabalho
# WORKDIR /var/www

# # Expor a porta HTTP esperada pelo Render
# EXPOSE 8080

# # Comando para iniciar o Nginx e o PHP-FPM juntos
# CMD ["sh", "-c", "service nginx start && php-fpm"]




# # Etapa 1: Construção do ambiente
# FROM php:8.2-fpm AS builder

# # Instalar dependências básicas e extensões necessárias
# RUN apt-get update && apt-get install -y \
#     git \
#     unzip \
#     libzip-dev \
#     libonig-dev \
#     curl \
#     libpng-dev \
#     libpq-dev \
#     && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# # Instalar Composer
# COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# # Definir diretório de trabalho
# WORKDIR /var/www

# # Copiar os arquivos do Laravel para o container
# COPY ./investidor_app/news /var/www

# # Instalar dependências do Laravel
# RUN composer install --no-dev --optimize-autoloader

# # Configurar permissões
# RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# # Gerar cache de configuração e otimizações
# RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# # # Etapa 2: Servidor de produção
# # FROM nginx:alpine

# # # Copiar configurações do Nginx
# # COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

# # # Copiar arquivos da aplicação
# # COPY --from=builder /var/www /var/www

# # # Configurar diretório de trabalho
# # WORKDIR /var/www

# # Copiar script de inicialização
# COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# # Expor a porta 9000 para o PHP-FPM
# EXPOSE 9000

# # Comando padrão ao iniciar o contêiner
# CMD php-fpm


# FROM php:8.2-fpm

# # Instalar dependências do sistema e PHP
# RUN apt-get update && apt-get install -y \
#     zip \
#     unzip \
#     git \
#     curl \
#     libfreetype6-dev \
#     libjpeg62-turbo-dev \
#     libpng-dev \
#     nginx \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql \
#     && pecl install xdebug \
#     && docker-php-ext-enable xdebug

# # Copiar o Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Definir diretório de trabalho
# WORKDIR /var/www

# # Copiar o código da aplicação
# COPY ./investidor_app/news /var/www

# # Instalar as dependências do Laravel com o Composer
# RUN composer install --no-dev --optimize-autoloader

# # Copiar configurações do Xdebug
# COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# # Copiar configuração do Nginx
# COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# # Ajustar permissões de diretório
# RUN chown -R www-data:www-data /var/www

# # Garantir que o PHP-FPM e o Nginx usem o usuário adequado
# USER www-data

# EXPOSE 8000

# CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]


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
