FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && \
    apt-get install -y \
        git curl zip unzip \
        libzip-dev libpng-dev libonig-dev libxml2-dev libpq-dev wkhtmltopdf && \
    docker-php-ext-install pdo pdo_mysql zip bcmath intl && \
    apt-get clean && rm -rf /var/lib/apt/lists/*
    
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Instala dependências (curl, etc)
RUN apt-get update && \
    apt-get install -y curl gnupg && \
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    apt-get clean
    
# Confirma as versões
RUN node -v && npm -v

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www

CMD ["php-fpm"]
