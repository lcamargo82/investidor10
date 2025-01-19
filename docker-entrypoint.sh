#!/bin/bash

wait_for_db() {
    echo "Aguardando o banco de dados ($DB_HOST:$DB_PORT) ficar disponível..."
    attempt=1
    until php -r "new PDO('mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME_ROOT', '$DB_PASSWORD_ROOT');" 2>/dev/null; do
        if [ $attempt -gt 10 ]; then
            echo "Banco de dados não está disponível após várias tentativas."
            exit 1
        fi
        sleep 5
        echo "Banco de dados ainda não está pronto. Tentando novamente... (Tentativa $attempt)"
        ((attempt++))
    done
    echo "Banco de dados está disponível!"
}

echo "Iniciando o entrypoint..."

cd /var/www/news

wait_for_db

if [ ! -f /var/www/news/.app_optimized ]; then
    echo "Otimização do Laravel para produção..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    touch /var/www/news/.app_optimized
else
    echo "Aplicação já foi otimizada."
fi

if [ ! -f /var/www/news/.migrations_done ]; then
    echo "Rodando as migrations e seeds..."
    php artisan migrate --force
    php artisan db:seed --force
    touch /var/www/news/.migrations_done
else
    echo "Migrations e seeds já foram executados."
fi

echo "Iniciando o PHP-FPM..."
exec php-fpm
