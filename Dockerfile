# Menggunakan image dasar PHP dengan Apache
FROM php:8.0-apache

# Menginstal ekstensi mysqli dan ekstensi tambahan yang dibutuhkan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy seluruh file aplikasi ke direktori Apache di dalam container
COPY . /var/www/html

# Mengatur izin agar Apache dapat mengakses file
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Mengatur document root ke public (opsional jika aplikasi Anda menggunakan folder 'public' sebagai root)
WORKDIR /var/www/html/public

# Expose port Apache
EXPOSE 80

# Menambahkan perintah untuk memulai Apache saat container dijalankan
CMD ["apache2-foreground"]
# Menggunakan image dasar PHP dengan Apache
FROM php:8.0-apache

# Menginstal ekstensi mysqli dan ekstensi tambahan yang dibutuhkan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy seluruh file aplikasi ke direktori Apache di dalam container
COPY . /var/www/html

# Mengatur izin agar Apache dapat mengakses file
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Mengatur document root ke public (opsional jika aplikasi Anda menggunakan folder 'public' sebagai root)
WORKDIR /var/www/html/public

# Expose port Apache
EXPOSE 80

# Menambahkan perintah untuk memulai Apache saat container dijalankan
CMD ["apache2-foreground"]
