FROM dunglas/frankenphp

RUN install-php-extensions \
 pdo_mysql \
 gd \
 intl \
 zip \
 opcache

ENV FRANKENPHP_CONFIG="worker ./public/index.php"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

COPY . .

RUN composer install

EXPOSE 80
