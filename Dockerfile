# Dockerfile

# Stage 1: Install PHP dependencies with Composer
FROM composer:2 as vendor

WORKDIR /app
COPY . .
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Stage 2: Install NPM dependencies and build assets
FROM node:18 as node_assets

WORKDIR /app
COPY . .
COPY --from=vendor /app/vendor /app/vendor
RUN npm install && npm run build

# Stage 3: Create the final application image
FROM php:8.2-fpm-alpine

WORKDIR /app

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy application files and built assets
COPY . .
COPY --from=vendor /app/vendor /app/vendor
COPY --from=node_assets /app/public/build /app/public/build

# Set correct file permissions
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]