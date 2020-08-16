FROM php:7.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

RUN apt update && apt upgrade -y \
  && apt install -y git zlib1g-dev libicu-dev g++ unzip \
  && docker-php-ext-configure intl \
  && docker-php-ext-install pdo pdo_mysql mysqli zip intl \
  && yes | pecl install xdebug \
  && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
  && a2enmod rewrite \
  && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80

# RUN apt update && apt upgrade -y \
#   && apt install -y git zlib1g-dev libicu-dev g++ unzip \
#   && docker-php-ext-configure intl \
#   && docker-php-ext-install pdo pdo_mysql mysqli zip intl \
#   && a2enmod rewrite \
#   && mkdir /var/www/html/data \
#   && chmod -R 777 /var/www/html/data \
#   && curl -sS https://getcomposer.org/installer \
#   | php -- --install-dir=/usr/local/bin --filename=composer

# EXPOSE 80

