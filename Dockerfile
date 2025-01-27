FROM php:8.2-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set document root to public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

WORKDIR /var/www/html

COPY . /var/www/html/

# Update Apache configuration and permissions
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && a2enmod rewrite headers

# Configure Apache virtual host
RUN echo '<VirtualHost *:80>' > /etc/apache2/sites-available/000-default.conf \
    && echo '    DocumentRoot ${APACHE_DOCUMENT_ROOT}' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    <Directory ${APACHE_DOCUMENT_ROOT}>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Options Indexes FollowSymLinks' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        AllowOverride All' >> /etc/apache2/sites-available/000-default.conf \
    && echo '        Require all granted' >> /etc/apache2/sites-available/000-default.conf \
    && echo '    </Directory>' >> /etc/apache2/sites-available/000-default.conf \
    && echo '</VirtualHost>' >> /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]