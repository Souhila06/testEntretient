# Utilisation de l'image PHP 8.0.3 avec FPM
FROM php:8.0.3-fpm

# Mise à jour des paquets et installation des dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Copie des fichiers de l'API Symfony dans le conteneur
COPY ./Backend /Backend

# Définition du répertoire de travail
WORKDIR /Backend

# Installation de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Désactivation des avertissements liés à l'installation de Composer
RUN export COMPOSER_ALLOW_SUPERUSER=1

# Mise à jour des dépendances avec Composer
RUN composer update

# Installation des dépendances Symfony sans exécuter les scripts ni demander d'interaction
RUN composer install --no-scripts --no-interaction


# Exposition du port sur lequel Symfony écoute
EXPOSE 8000

# Commande pour démarrer le serveur Symfony
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
