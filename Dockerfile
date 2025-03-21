FROM php:8.3-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    openssl \
    zip \
    unzip \
    curl \
    nodejs \
    npm \
    bash \
    git \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install zip pdo pdo_mysql

# Définir le répertoire de travail standard pour Laravel
WORKDIR /var/www/html

# Copier les fichiers du projet (le repo sera monté en volume)
COPY . .

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Optimiser l'installation Composer
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader

# Installer les dépendances front-end
COPY package.json package-lock.json ./
RUN npm install && npm run build

# Régler les permissions pour Laravel
RUN chmod -R 777 storage bootstrap/cache

# Exposer le port Laravel
EXPOSE 8000

# Lancer le serveur Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
