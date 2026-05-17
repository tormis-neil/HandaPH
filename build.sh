#!/usr/bin/env bash
# exit on error
set -o errexit

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "Installing Node dependencies..."
npm install

echo "Building frontend assets..."
npm run build

echo "Caching Laravel configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running database migrations and seeders..."
php artisan migrate --force
php artisan db:seed --force
