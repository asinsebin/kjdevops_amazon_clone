FROM php:7.4-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Install pytest
RUN apt-get update && apt-get install -y python3-pytest

RUN apt-get update && apt-get install -y nohup

pen_spark


# Copy your application files
COPY . /var/www/html

# Set Apache document root
WORKDIR /var/www/html
