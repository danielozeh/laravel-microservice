FROM php:8.1-alpine

WORKDIR /var/www/users

COPY composer.json composer.lock .
RUN composer install

COPY . .

EXPOSE 8000

CMD ["php", "artisan", "serve"]