# Menggunakan PHP-FPM untuk Nginx [cite: 2771]
FROM php:8.2-fpm

# Install ekstensi MySQLi yang dibutuhkan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory [cite: 2776]
WORKDIR /var/www/html

# Salin kode aplikasi
COPY . /var/www/html/

# Atur hak akses folder (penting untuk PHP-FPM) [cite: 2778]
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 9000 (port standar PHP-FPM) [cite: 2779]
EXPOSE 9000
