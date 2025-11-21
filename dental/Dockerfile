# Build Vue (Inertia) assets
FROM node:18-alpine as build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Laravel PHP image
FROM php:8.2-fpm

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libpng-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www

# Copy Laravel files
COPY . .

# Copy built Vue assets
COPY --from=build /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Fix permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

CMD ["php-fpm"]
