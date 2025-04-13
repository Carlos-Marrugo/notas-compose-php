FROM php:8.1-fpm-alpine

RUN apk update && \
    apk add --no-cache \
    mysql-client \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    && docker-php-ext-enable \
    pdo_mysql