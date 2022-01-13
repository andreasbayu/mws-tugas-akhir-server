FROM php:8.0-apache
RUN apt-get update && \
    apt-get install -y
RUN apt-get install -y curl
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev
RUN apt-get install -y libicu-dev
COPY server.conf /etc/apache2/sites-enabled/server.conf
RUN apt-get update
RUN docker-php-ext-install intl
RUN docker-php-ext-configure intl
RUN docker-php-ext-install mysqli pdo pdo_mysql zip mbstring
RUN apachectl restart
RUN a2enmod rewrite
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd
RUN chmod -R 777 /var/www/html/app/writable
RUN service apache2 restart