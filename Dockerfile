# Use the official PHP image from Docker Hub
FROM php:8.1-apache

# Copy your application code into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install necessary PHP extensions (PDO for PostgreSQL)
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Expose port 80 for web traffic
EXPOSE 80
