FROM php:8.3-alpine

RUN apk add --no-cache \
    curl \
    curl-dev \
    libzip-dev \
    linux-headers \
    pcre-dev \
    libpq-dev \
    icu-dev \
    ${PHPIZE_DEPS}

RUN pecl install xhprof

RUN docker-php-ext-configure curl
RUN docker-php-ext-configure zip

RUN docker-php-ext-install \
    opcache \
    curl \
    pcntl \
    sockets \
    zip

RUN docker-php-ext-install pdo pdo_pgsql

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

RUN docker-php-ext-enable \
    xhprof \
    opcache

WORKDIR /app

EXPOSE 8000

CMD php artisan octane:start --host=0.0.0.0 --workers=1
