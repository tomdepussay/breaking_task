#!/bin/bash

set -e

cd /var/www/html || { echo "/var/www/html directory not found"; exit 1; }

host="$1"
port="$2"

if [ -z "$host" ]; then
    host="db"
fi

if [ -z "$port" ]; then
    port="5432"
fi

while ! nc -z "$host" "$port"; do
    echo "Waiting for database at $host:$port..."
    sleep 1
done

echo "Database is ready!"
php artisan key:generate
php artisan migrate --seed
php artisan serve --host=0.0.0.0 --port=80