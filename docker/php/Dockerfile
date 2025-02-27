# Usa a imagem oficial do PHP com FPM
FROM php:8.2-fpm

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho dentro do container
WORKDIR /var/www

# Copia os arquivos do projeto para dentro do container
COPY . .

# Dá permissões para a pasta de cache e logs do Symfony
RUN chown -R www-data:www-data /var/www/var

# Exibe os logs no console
CMD ["php-fpm"]
