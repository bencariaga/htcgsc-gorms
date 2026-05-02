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
    nginx \
    postgresql-dev \
    nodejs \
    npm \
    chromium \
    nss \
    freetype \
    harfbuzz \
    ca-certificates \
    ttf-freefont \
    imagemagick \
    imagemagick-dev \
    autoconf \
    g++ \
    make \
    icu-dev

RUN pecl install imagick \
    && docker-php-ext-enable imagick

RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip intl

ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD=true
ENV PUPPETEER_EXECUTABLE_PATH=/usr/bin/chromium-browser

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer update --no-dev --optimize-autoloader --no-interaction

RUN npm install

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY ./docker/nginx.conf /etc/nginx/http.d/default.conf

EXPOSE 80

CMD ["sh", "-c", "nginx && php-fpm"]
