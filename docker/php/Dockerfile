FROM php:7.2-fpm-alpine

RUN apk add --no-cache $PHPIZE_DEPS autoconf c-client cmake curl git g++ mysql-client openssh-client python \
   cyrus-sasl-dev icu-dev icu-libs imap imap-dev libmcrypt libmcrypt-dev libmemcached libmemcached-dev \
   libxml2 libxml2-dev postgresql-dev postgresql-libs rabbitmq-c rabbitmq-c-dev sqlite-dev sqlite-libs zlib zlib-dev \
&& pecl install amqp memcached redis xdebug \
&& docker-php-ext-enable amqp memcached redis xdebug \
&& docker-php-ext-install bcmath imap intl mbstring opcache pcntl pdo pdo_mysql pdo_pgsql soap zip \
&& apk info | grep "\-dev" | xargs apk del autoconf dpkg file g++ gcc pkgconf re2c python \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/project