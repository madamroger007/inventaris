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

# Copy semua file ke container
COPY . /var/www

# Set permissions storage & bootstrap
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Tambah konfigurasi Laravel agar .htaccess bekerja
RUN echo '<Directory /var/www/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel
