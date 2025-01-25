#!/bin/bash

# Verificar se o banco de dados está acessível
echo "Aguardando o banco de dados estar disponível..."
until nc -z -v -w30 db 3306; do
    echo "Aguardando conexão com o banco de dados..."
    sleep 1
done
echo "Banco de dados disponível!"

# Executar migrações do Laravel
# echo "Executando migrações do Laravel..."
# php artisan migrate --force

# Iniciar o PHP-FPM
echo "Iniciando PHP-FPM..."
php-fpm
