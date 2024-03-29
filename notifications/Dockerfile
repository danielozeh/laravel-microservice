FROM php:8.2-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev

RUN apt-get install -y default-mysql-client

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure gd
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/notifications

# Copy existing application directory permissions
COPY --chown=www:www/notifications . /var/www/notifications


# RUN composer install --ignore-platform-req=ext-sockets

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 8001
CMD ["php-fpm"]
CMD ["php", "artisan", "broker:listen"]