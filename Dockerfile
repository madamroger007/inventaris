FROM php:8.3-apache

# Install dependencies & ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && docker-php-ext-enable intl

# Aktifkan mod_rewrite untuk Laravel
RUN a2enmod rewrite

# Ubah DocumentRoot ke folder Laravel public
RUN sed -i 's|/var/www/html|/var/www/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/public|g' /etc/apache2/apache2.conf

# Set working dir
WORKDIR /var/www

# Copy composer files dulu biar caching lebih efisien
COPY composer.json composer.lock ./

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install vendor (inside container)
RUN composer install --no-dev --optimize-autoloader

# Copy semua file ke container
COPY . .

# Set permissions storage & bootstrap
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Tambah konfigurasi Laravel agar .htaccess bekerja
RUN echo '<Directory /var/www/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

EXPOSE 80
