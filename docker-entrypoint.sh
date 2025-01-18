#!/bin/bash

echo "Aguardando o banco de dados..."
until mysqladmin ping -h"$DB_HOST" --silent; do
  sleep 1
done

echo "Banco de dados está pronto. Iniciando aplicação..."
php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=8000
