#!/bin/bash

wait_for_db() {
    echo "Aguardando o banco de dados ($DB_HOST:$DB_PORT) ficar disponível..."
    until php -r "new PDO('mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD');" 2>/dev/null; do
        sleep 3
        echo "Banco de dados ainda não está pronto. Tentando novamente..."
    done
    echo "Banco de dados está disponível!"
}

wait_for_db

echo "Rodando as migrations e seeds..."
php artisan migrate --force
php artisan db:seed --force

echo "Iniciando o servidor Laravel na porta 8000..."
exec php artisan serve --host=0.0.0.0 --port=8000

