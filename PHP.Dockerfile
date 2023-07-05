FROM php:5.6.30-fpm-alpine

COPY . /app
WORKDIR /app


RUN docker-php-ext-enable gd


