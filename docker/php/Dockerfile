FROM php:8.4.1-fpm
RUN apt-get update && apt-get install -y libmemcached-dev zlib1g-dev libpng-dev libjpeg-dev libzip-dev zip \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-install zip \
    && docker-php-ext-install mysqli
RUN apt-get install -y git unzip
RUN apt-get update && apt-get install -y libicu-dev && rm -rf /var/lib/apt/lists/*
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN apt-get update
RUN apt-get install -y nano
#RUN echo 'max_execution_time = 600; memory_limit=200M' >> /usr/local/etc/php/conf.d/docker-php-maxexectime.ini;
