#!/bin/bash

until mysqladmin ping -h mysql --silent; do
    echo "Waiting for mysql to be ready..."
    sleep 2
done

php artisan migrate --force

exec "$@"
