FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql

COPY . /app
WORKDIR /app
