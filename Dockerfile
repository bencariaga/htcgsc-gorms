FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    libzip-dev \
    unzip \
    nginx

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock* /var/www/

RUN composer install --no-dev --no-scripts --optimize-autoloader

COPY . /var/www

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY ./docker/nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 80

CMD ["sh", "-c", "nginx && php-fpm"]
