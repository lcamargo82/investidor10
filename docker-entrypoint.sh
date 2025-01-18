#!/bin/bash

wait_for_db() {
    echo "Esperando o banco de dados ficar disponível..."
    until php -r "new PDO('mysql:host=127.0.0.1;port=$DB_PORT;', '$DB_USERNAME', '$DB_PASSWORD');" 2>/dev/null; do
        sleep 2
        echo "Ainda esperando pelo banco de dados..."
    done
    echo "Banco de dados está disponível!"
}

wait_for_db

echo "Rodando as migrations e seeds..."
php artisan migrate --force
php artisan db:seed --force

echo "Iniciando o servidor Laravel na porta 8000..."
exec php artisan serve --host=0.0.0.0 --port=8000
