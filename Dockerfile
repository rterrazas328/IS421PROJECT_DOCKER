FROM php:5.6-fpm-jessie

# Update apt sources to point to the Debian archive for Jessie EOL repositories
RUN echo "deb http://archive.debian.org/debian/ jessie main" > /etc/apt/sources.list \
    && echo "deb-src http://archive.debian.org/debian/ jessie main" >> /etc/apt/sources.list \
    && echo "deb http://archive.debian.org/debian-security jessie/updates main" >> /etc/apt/sources.list \
    && echo "deb-src http://archive.debian.org/debian-security jessie/updates main" >> /etc/apt/sources.list

# Install system dependencies, allowing unauthenticated packages from the archive
RUN apt-get update && apt-get install -y --allow-unauthenticated \
    build-essential \
    libmcrypt-dev \
    git \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring tokenizer mcrypt

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-scripts

# Ensure storage and bootstrap/cache directories exist before setting permissions
RUN mkdir -p storage bootstrap/cache

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port 8000 and start php-fpm server
EXPOSE 8000
#CMD ["php-fpm"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]