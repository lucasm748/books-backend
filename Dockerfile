FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql


COPY . /var/www

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh

WORKDIR /var/www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN apt-get update && apt-get install -y default-mysql-client

RUN php artisan key:generate
RUN php artisan optimize
RUN php artisan storage:link

RUN chown -R www-data:www-data /var/www
RUN chmod -R 755  storage bootstrap/cache
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["php-fpm"]
