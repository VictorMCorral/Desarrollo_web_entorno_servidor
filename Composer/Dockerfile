# Dockerfile
FROM php:8.3-cli

# Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Descargar e instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /app

# Establecer permisos y usuario (opcional, pero recomendado)
RUN useradd -m -u 1000 developer
USER developer
WORKDIR /home/developer/app