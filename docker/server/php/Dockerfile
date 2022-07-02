FROM php:8.0-fpm

ENV HOME /root
ENV LC_ALL          C.UTF-8
ENV LANG            en_US.UTF-8
ENV LANGUAGE        en_US.UTF-8

# RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev \
#    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
#    && docker-php-ext-install -j$(nproc) gd

# RUN mkdir -p /usr/local/openssl/include/openssl/ && \
#   ln -s /usr/include/openssl/evp.h /usr/local/openssl/include/openssl/evp.h && \
#    mkdir -p /usr/local/openssl/lib/ && \
#    ln -s /usr/lib/x86_64-linux-gnu/libssl.a /usr/local/openssl/lib/libssl.a && \
#    ln -s /usr/lib/x86_64-linux-gnu/libssl.so /usr/local/openssl/lib/

RUN pecl channel-update pecl.php.net
RUN pecl install mongodb

# RUN echo "extension=mongodb.so" > /etc/php/7.2/fpm/conf.d/20-mongodb.ini && \
#	echo "extension=mongodb.so" > /etc/php/7.2/cli/conf.d/20-mongodb.ini && \
#	echo "extension=mongodb.so" > /etc/php/7.2/mods-available/mongodb.ini