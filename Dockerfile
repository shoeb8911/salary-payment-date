# Use the official PHP 8.2 image with CLI support
FROM php:8.2-cli

# Set working directory in the container
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy existing application files to the container
COPY . /app

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set up application command to run
CMD ["php", "artisan", "generate:payment-dates"]
