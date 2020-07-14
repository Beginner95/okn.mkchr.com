FROM php:7.4-fpm

ENV TIMEZONE Europe/Moscow
ENV PHP_MEMORY_LIMIT    512M
ENV UPLOAD_MAX_FILESIZE 50M
ENV PHP_MAX_POST        100M
ENV SHORT_OPEN_TAG      Off

ENV TZ $TIMEZONE
RUN apt-get update && apt-get install -y tzdata && \
    rm /etc/localtime && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

RUN apt-get install -y curl libpq-dev libzip-dev zip unzip git wget libsqlite3-dev dos2unix libfreetype6-dev libmcrypt-dev \
    libpng16-16 libjpeg-dev libpng-dev libxslt-dev libwebp-dev libjpeg62-turbo-dev libxpm-dev \
    libicu-dev libmemcached-dev libmagick++-dev libmagickwand-dev libzip-dev cron libgmp-dev

RUN docker-php-ext-install -j$(nproc) iconv json zip

RUN curl -s https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install zip pdo pdo_mysql opcache sockets pcntl intl xml soap iconv bcmath bz2 gettext xsl gmp

RUN apt-get install -y libc-client-dev libkrb5-dev && docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-install imap

RUN pecl install imagick-3.4.3 && docker-php-ext-enable imagick

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN apt-get clean && apt-get -y autoremove
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/ /usr/share/man/ /usr/share/locale/

RUN ln -s /usr/local/bin/php /bin/php

RUN usermod -u 1000 www-data

RUN usermod -s /bin/bash -d /home/www-data www-data && mkdir -p /home/www-data && chown -R www-data.www-data /home/www-data

COPY .ssh /home/www-data/.ssh
COPY .ssh /root/.ssh
RUN chown -R root.root /root/.ssh && chown -R www-data.www-data /home/www-data/.ssh && chmod -R 0600 /home/www-data/.ssh /root/.ssh && chmod 0700 /home/www-data/.ssh /root/.ssh

RUN curl -fsSLO https://github.com/aptible/supercronic/releases/download/v0.1.8/supercronic-linux-amd64 \
    && chmod +x supercronic-linux-amd64 \
    && mv supercronic-linux-amd64 "/usr/local/bin/supercronic-linux-amd64" \
    && ln -s "/usr/local/bin/supercronic-linux-amd64" /usr/local/bin/supercronic


RUN echo "[PHP]" > /usr/local/etc/php/php.ini && \
    echo "date.timezone = ${TIMEZONE}" >> /usr/local/etc/php/php.ini && \
    echo "memory_limit = ${PHP_MEMORY_LIMIT}" >> /usr/local/etc/php/php.ini && \
    echo "short_open_tag = ${SHORT_OPEN_TAG}" >> /usr/local/etc/php/php.ini && \
    echo "post_max_size = ${PHP_MAX_POST}" >> /usr/local/etc/php/php.ini && \
    echo "upload_max_filesize = ${UPLOAD_MAX_FILESIZE}" >> /usr/local/etc/php/php.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/php.ini

WORKDIR /app

COPY php/ /usr/local/etc/

CMD ["php-fpm"]
