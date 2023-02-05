#!/bin/bash

# App
composer install
cp .env.example .env
php artisan key:generate

# NPM
npm install && npm run build

# Sail
php artisan sail:install
./vendor/bin/sail up -d

# Init
./vendor/bin/sail artisan migrate --seed
