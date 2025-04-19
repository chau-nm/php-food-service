FROM php:8.4-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo mysqli pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /srv/app
VOLUME /srv/app/var

COPY docker/etc/apache2/sites-enabled/000-site.conf /etc/apache2/sites-enabled/000-site.conf 
COPY docker/etc/php/php-conf.ini /usr/local/etc/php/php-conf.ini
COPY docker/etc/apache2/ports/ports.conf /etc/apache2/ports.conf

EXPOSE 80 8080

CMD ["apache2-foreground"]