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

RUN apk add --no-cache git
RUN git clone https://github.com/nikic/php-ast.git /usr/src/php/ext/ast
RUN docker-php-ext-install ast

RUN pecl install -f vld \
    && docker-php-ext-enable vld

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /app

EXPOSE 8000

CMD php artisan octane:start --host=0.0.0.0 --workers=10
