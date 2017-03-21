FROM php:7.1-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update

# PHP extensions and tools
RUN apt-get install -y libicu-dev && docker-php-ext-install intl
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_mysql
RUN apt-get install -y zlib1g zlib1g-dev && docker-php-ext-configure zip --with-zlib-dir="/usr" && docker-php-ext-install zip
RUN apt-get install -y libgd3 libfreetype6-dev libjpeg62-turbo-dev libpng12-dev && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && docker-php-ext-install gd
#RUN apt-get install -y wkhtmltopdf xvfb
RUN docker-php-ext-install exif mbstring opcache
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

# Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN composer config -g github-oauth.github.com 280d2a42f491ea6b12f03236c6084d76c691afe7
ENV COMPOSER_ALLOW_SUPERUSER 1

# Clean
RUN apt-get autoremove -y
RUN rm -rf /var/lib/apt/lists/*

COPY run.sh /home/run.sh
RUN chmod +x /home/run.sh

CMD ["/home/run.sh"]
