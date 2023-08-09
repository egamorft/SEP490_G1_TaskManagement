# Use an official PHP image as the base image
FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www/html


# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install zip pdo pdo_mysql bcmath exif && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the source code into the container
COPY . .
ENV COMPOSER_ALLOW_SUPERUSER=1
# Install PHP dependencies using Composer
RUN composer update --no-scripts
RUN composer dump-autoload
RUN composer install --no-interaction

# Install JavaScript dependencies using npm
RUN npm install

# Build production assets using npm
RUN npm run prod

# Expose port 9000 and start PHP-FPM server
EXPOSE 8000
CMD php artisan serve
