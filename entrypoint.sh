#!/bin/bash

# Aguarde até que o MySQL esteja pronto
until mysqladmin ping -h mysql --silent; do
    echo "Aguardando o MySQL estar disponível..."
    sleep 2
done

# Execute as migrations
php artisan session:table
php artisan migrate --force
# Execute o CMD
exec "$@"
