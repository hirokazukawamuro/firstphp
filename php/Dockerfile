FROM php:8.2.1-apache

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get install -y libonig-dev git && \
    docker-php-ext-install pdo_mysql mysqli mbstring