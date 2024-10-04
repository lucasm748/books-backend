#!/bin/bash

until mysqladmin ping -h mysql --silent; do
    echo "Waiting for mysql to be ready..."
    sleep 2
done

php artisan migrate --force

chown -R www-data:www-data /var/www/storage
chmod -R 775 /var/www/storage

exec "$@"
