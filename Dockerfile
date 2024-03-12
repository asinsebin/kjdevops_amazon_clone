FROM php:7.4-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy your application files
COPY . /var/www/html

# Set Apache document root
WORKDIR /var/www/html
