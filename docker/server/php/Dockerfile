FROM devilbox/php-fpm-8.2
# FROM php:8.1-fpm

ENV HOME /root
ENV LC_ALL          C.UTF-8
ENV LANG            en_US.UTF-8
ENV LANGUAGE        en_US.UTF-8

RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev \
   && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
   && docker-php-ext-install -j$(nproc) gd

# RUN libcurl4-openssl-dev pkg-config libssl-dev -y

RUN mkdir -p /usr/local/openssl/include/openssl/ && \
  ln -s /usr/include/openssl/evp.h /usr/local/openssl/include/openssl/evp.h && \
   mkdir -p /usr/local/openssl/lib/ && \
   ln -s /usr/lib/x86_64-linux-gnu/libssl.a /usr/local/openssl/lib/libssl.a && \
   ln -s /usr/lib/x86_64-linux-gnu/libssl.so /usr/local/openssl/lib/


RUN apt-get update && apt-get install -y git
RUN mkdir /usr/local/logs
RUN touch /usr/local/logs/php.log

# RUN pecl install xdebug \
#    && docker-php-ext-enable xdebug

RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev -y
RUN pecl channel-update pecl.php.net
RUN pecl install mongodb
RUN curl -sS https://getcomposer.org/installer | php 
RUN mv composer.phar /usr/bin/composer
RUN composer require mongodb/mongodb --ignore-platform-reqs
# RUN composer require tymon/jwt-auth
# RUN composer require firebase/php-jwt


# RUN echo "display_errors = On" >> /usr/local/etc/php/php.ini-development
# RUN echo "error_reporting = E_ALL & ~E_NOTICE" >> /usr/local/etc/php.ini-development
# RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini-development

# RUN cat /usr/local/etc/php.ini-development > /usr/local/etc/php/php.ini-production

# RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/docker-php-ext-sodium.ini 



RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini