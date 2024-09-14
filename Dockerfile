FROM php:7.2-fpm-alpine

RUN apk update && apk upgrade

# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add git zip unzip curl sqlite nginx supervisor

RUN apk add nodejs npm

# Install PHP extensions
RUN apk add php7-gd \
    php7-imap \
    php7-redis \
    php7-cgi \
    php7-bcmath \
    php7-mysqli \
    php7-zlib \
    php7-curl \
    php7-zip \
    php7-mbstring \
    php7-iconv \
    gmp-dev

# dependencies required for running "phpize"
ENV PHPIZE_DEPS \
    autoconf \
    dpkg-dev \
    dpkg \
    file \
    g++ \
    gcc \
    libc-dev \
    make \
    pkgconf \
    re2c \
    zlib \
    wget

# Install packages
RUN set -eux; \
    # Packages needed only for build
    apk add --virtual .build-deps \
    $PHPIZE_DEPS

RUN apk add --no-cache linux-headers

# Packages to install
RUN apk add curl \
    freetype-dev \
    gettext-dev \
    libmcrypt-dev \
    icu-dev \
    libpng \
    libpng-dev \
    libressl-dev \
    libtool \
    libxml2-dev \
    libzip-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    oniguruma-dev \
    unzip 

# pecl PHP extensions
RUN pecl install \
    mongodb \
    redis
# Configure PHP extensions
RUN docker-php-ext-configure \
    gd --enable-gd --with-freetype --with-jpeg --with-webp
# Install PHP extensions
RUN  docker-php-ext-install \
    bcmath \
    bz2 \
    exif \
    ftp \
    gettext \
    gd \
    intl \
    gmp \
    mbstring \
    opcache \
    pdo \
    pdo_mysql \
    shmop \
    sockets \
    sysvmsg \
    sysvsem \
    sysvshm \
    zip \
    && \
    # Enable PHP extensions
    docker-php-ext-enable \
    mongodb \
    redis \
    && \
    # Remove the build deps
    apk del .build-deps \
    && \
    # Clean out directories that don't need to be part of the image
    rm -rf /tmp/* /var/tmp/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php

# Configure supervisor
RUN mkdir -p /etc/supervisor.d/
RUN touch /run/supervisord.sock
COPY ./docker-compose/supervisord/supervisord.ini /etc/supervisor.d/supervisord.ini

# Cron Config
COPY ./docker-compose/crontab /etc/crontabs/root

# Config PHP
COPY ./docker-compose/php/local.ini /usr/local/etc/php/php.ini

# Install Laravel Echo Server
RUN npm install -g laravel-echo-server

# Nginx configuration
RUN mkdir -p /run/nginx/
RUN touch /run/nginx/nginx.pid

COPY ./docker-compose/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker-compose/nginx/conf.d/app.conf /etc/nginx/http.d/default.conf

RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

USER root
WORKDIR /var/www

EXPOSE 80

CMD ["supervisord", "-c", "/etc/supervisor.d/supervisord.ini"]
