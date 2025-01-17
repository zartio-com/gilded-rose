#!/bin/sh

docker run --rm -v "$(pwd)":/app -w /app composer:latest composer install
docker run --rm -v "$(pwd)":/app -w /app php:8.1-cli vendor/bin/phpunit