FROM php:8.4-fpm AS app

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader \
    && cp .env.example .env \
    && php artisan key:generate --force \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]

FROM nginx:alpine AS web

COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=app /var/www/public /var/www/public
