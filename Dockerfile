# Stage 1: Build the application
FROM node:16-alpine AS node

# Set working directory
WORKDIR /app

# Install dependencies
WORKDIR /app
COPY . .
RUN apk add --no-progress --quiet --no-cache git \
    && git config --global url."https://".insteadOf git:// \
    && yarn cache clean \
    && yarn install \
    && yarn build

# Stage 2: PHP-FPM and Nginx setup
FROM php:7.2-fpm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Remove default server definition
RUN rm /etc/nginx/sites-enabled/default

# Copy custom Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Copy PHP-FPM configuration
COPY php-fpm.conf /usr/local/etc/php-fpm.conf

# Copy Laravel application files
COPY --from=node /app /var/www/html

# Set working directory
WORKDIR /var/www/html

# Expose ports
EXPOSE 80

# Start services
CMD service nginx start && php-fpm
