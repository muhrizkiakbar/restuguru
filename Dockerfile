# Stage 1: Base PHP image with dependencies
FROM php:7.2-fpm as base

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
    libmcrypt-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    nginx \
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

# Install PHP dependencies with Composer (no-dev, ignoring platform requirements)
RUN composer install --no-dev --ignore-platform-reqs --no-scripts --no-progress --prefer-dist --optimize-autoloader

# Install npm dependencies for the project
RUN npm install

# Build frontend assets (if necessary)
RUN npm run prod

# Stage 2: Final image with Nginx and Supervisor
FROM php:7.2-fpm

# Copy over the built app from the previous stage
COPY --from=base /var/www/html /var/www/html
COPY --from=base /etc/nginx /etc/nginx
COPY --from=base /etc/supervisor /etc/supervisor

# Copy custom nginx configuration
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Ensure the nginx service is started with PHP-FPM and Supervisor
COPY ./supervisor/supervisord.conf /etc/supervisord.conf

# Expose HTTP and HTTPS ports
EXPOSE 80
EXPOSE 443

# Start services with Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
