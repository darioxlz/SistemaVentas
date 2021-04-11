# base image
FROM php:7.4.16-apache

# COPY --from=node:15.13.0-alpine3.10 . .

# root privileges
USER root
WORKDIR /sistema-ventas


# apt-get
RUN apt-get update
RUN curl -fsSL https://deb.nodesource.com/setup_15.x | bash -
RUN apt-get install -y nodejs
RUN apt-get -y install bzip2 vim wget zip unzip libpng-dev libpq-dev
RUN apt-get -y install libmcrypt-dev libzip-dev zziplib-bin zlib1g-dev libonig-dev


# docker-php ext-install
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_pgsql pgsql gd

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./composer.json ./composer.json
COPY ./composer.lock ./composer.lock
COPY ./package.json ./package.json

RUN composer install --no-interaction --no-scripts
RUN npm install

# tell apache where is the folder to serve
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# copy laravel project to WORKDIR
COPY . ./
RUN npm run dev

# copy script to run after create container
COPY .docker/docker-php-entrypoint /usr/local/bin/
RUN chmod 755 /usr/local/bin/docker-php-entrypoint

RUN chown -R www-data:www-data ./ && a2enmod rewrite
RUN chown -R www-data:www-data storage
