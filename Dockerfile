# Use an updated official PHP runtime as a parent image with Apache
FROM php:8.2-apache

# Install any needed extensions (example: mysqli for database operations)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the application source code to the container
COPY . .

# Expose port 80 for the Apache server
EXPOSE 80

# Set up environment variables
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Configure Apache Document Root to use the environment variable
RUN sed -i -e 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' /etc/apache2/sites-available/*.conf
RUN sed -i -e 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' /etc/apache2/apache2.conf
RUN sed -i -e 's|/var/www/html|${APACHE_DOCUMENT_ROOT}|g' /etc/apache2/conf-available/*.conf

# Set ServerName to suppress FQDN warning
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf

# Enable mod_rewrite for URL rewriting
RUN a2enmod rewrite

# Start Apache server in the foreground
CMD ["apache2-foreground"]
