FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git unzip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www
COPY . .

# Install PHP and Node dependencies
RUN composer install --no-dev --optimize-autoloader
RUN apt-get install -y nodejs npm && npm install && npm run build

# Setup permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000