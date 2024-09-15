# Stage 1: Base PHP image with dependencies
FROM php:7.2-fpm AS base

# Set environment variables
ENV DEBIAN_FRONTEND=noninteractive

# Install necessary system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpq-dev \
    build-essential \
    python2 \
    npm \
    supervisor

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js v16 and npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

# Copy application code
WORKDIR /var/www/html
COPY . .

# Clean npm cache and install dependencies
# Uncomment if needed for a Laravel project
# RUN npm cache clean --force
# RUN rm -rf node_modules package-lock.json
# RUN npm install

# Build frontend assets (if necessary)
# RUN npm run prod

# Stage 2: Nginx setup
FROM nginx:alpine AS nginx

# Copy custom nginx configuration
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Stage 3: Final application setup with Supervisor
FROM php:7.2-fpm

# Install Supervisor in the final stage
RUN apt-get update && apt-get install -y supervisor

# Copy over the built app and configuration from previous stages
COPY --from=base /var/www/html /var/www/html
COPY --from=nginx /etc/nginx /etc/nginx

# Copy Supervisor configuration
COPY ./supervisor/supervisord.conf /etc/supervisord.conf

# Expose HTTP and HTTPS ports
EXPOSE 80 443

# Copy startup script to ensure services start correctly
COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Start services with Supervisor (Nginx + PHP-FPM)
CMD ["/usr/local/bin/docker-entrypoint.sh"]
