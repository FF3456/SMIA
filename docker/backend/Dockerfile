# docker/backend/Dockerfile
# SMIA Backend — PHP 8.3 + Laravel 11

FROM php:8.3-fpm-alpine

# Extensiones PHP necesarias para Laravel + PostgreSQL
RUN apk add --no-cache \
      postgresql-dev \
      libzip-dev \
      oniguruma-dev \
      git \
    && docker-php-ext-install \
      pdo_pgsql \
      pgsql \
      mbstring \
      zip \
      opcache

# Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Instalar dependencias en capa separada (caché Docker)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Permisos de Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
