
# ==========================================
# STAGE 1: BUILD FRONTEND (VITE)
# ==========================================
FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build


# ==========================================
# STAGE 2: LARAVEL + PHP + APACHE
# ==========================================
FROM php:8.2-apache

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j1 \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy Laravel source code
COPY . .

# Install production PHP dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Copy compiled Vite assets
COPY --from=frontend /app/public/build ./public/build

# Configure Apache document root

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    's!/var/www/html!/var/www/html/public!g' \
    /etc/apache2/sites-available/000-default.conf \
    && sed -ri \
    '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' \
    /etc/apache2/apache2.conf \
    && a2enmod rewrite headers

# Set Laravel permissions
RUN chown -R www-data:www-data \
    storage \
    bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Render web service port
EXPOSE 1006

# Start Apache on Render PORT
CMD ["sh", "-c", "PORT=${PORT:-1006}; sed -i \"s/Listen 80/Listen ${PORT}/\" /etc/apache2/ports.conf; sed -i \"s/:80>/:${PORT}>/\" /etc/apache2/sites-available/000-default.conf; exec apache2-foreground"]
