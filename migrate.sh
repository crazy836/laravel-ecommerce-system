#!/bin/bash
echo "Running Laravel migrations..."
php artisan migrate --force
echo "Migrations completed!"