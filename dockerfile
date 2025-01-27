# Menggunakan image dasar FrankenPHP
FROM dunglas/frankenphp:php8.3

ENV FRANKENPHP_CONFIG="worker ./public/index.php"
# Install dependensi Alpine dan PHP Extensions
RUN install-php-extensions \
    pdo_mysql \
    mysqli \
    gd \
    intl \
    zip \
    opcache

# Set working directory
WORKDIR /app

# Copy semua file proyek ke dalam container
COPY . /app

# Pastikan folder writable memiliki izin tulis
RUN chmod -R 0777 /app/writable
