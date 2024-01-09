FROM php:8.0-apache

RUN docker-php-ext-install pdo_mysql

RUN apt-get update && apt-get install -y \
        git \
        zip \
        unzip \
  && rm -rf /var/lib/apt/lists/* \
  && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
  && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
  && php -r "unlink('composer-setup.php');"

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite

WORKDIR /var/www/html

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/!&html/public/!g' /etc/apache2/apache2.conf

RUN composer install

