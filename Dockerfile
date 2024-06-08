FROM php:7.4-cli

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install

COPY . .

RUN composer require --dev phpunit/phpunit ^9.0

CMD ["php", "-a"]

