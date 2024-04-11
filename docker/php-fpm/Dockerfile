FROM phpdockerio/php:8.2-fpm
WORKDIR "/application"

RUN apt-get update; \
    apt-get -y --no-install-recommends install \
        git \
        supervisor \
        openssh-client \
        php8.2-gd \
        php8.2-mcrypt \
        php8.2-mysql \
        php8.2-intl \
        php8.2-gmp \
        php8.2-xdebug \
        php8.2-bcmath \
        php8.2-redis; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
