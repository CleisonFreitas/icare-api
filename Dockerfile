FROM php:8.4-fpm-alpine

ARG UID=1000
ARG GID=1000

RUN addgroup -g ${GID} app \
 && adduser -D -u ${UID} -G app app

RUN apk add --no-cache \
    bash git curl \
    libpng-dev libjpeg-turbo-dev freetype-dev \
    libzip-dev oniguruma-dev icu-dev postgresql-dev \
    $PHPIZE_DEPS

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    mbstring \
    zip \
    exif \
    pcntl \
    intl \
    gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

USER www-data

CMD ["php-fpm"]