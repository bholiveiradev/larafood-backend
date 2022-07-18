FROM php:8-fpm

RUN apt-get update -y && apt-get install -y libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6-dev
RUN apt-get update && \
    apt-get install -y \
    zlib1g-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    libpq-dev \
    libxml2-dev

RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    simplexml \
    opcache \
    xml \
    mbstring \
    curl \
    zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update -y && apt-get install -y nodejs npm

EXPOSE 9000
WORKDIR "/var/www/html"
