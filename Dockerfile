FROM php:7.4-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Obtener la ultima version de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#Persmisos de reescritura
RUN a2enmod rewrite

ENV COMPOSER_ALLOW_SUPERUSER 1
# Creamos el directorio para poder darle permisos a www-data
COPY  . /var/www/html
# Establecer directorio de trabajo
WORKDIR /var/www/html
# Le damos permisos a www-data
RUN chown -R www-data:www-data /var/www/
