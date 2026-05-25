FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl gnupg
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd

# Install Node.js (v20)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

# Install PHP dependencies first
RUN composer install --no-dev --optimize-autoloader

# Install JS dependencies and build assets
RUN npm install
RUN npm run build

# Setup permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000