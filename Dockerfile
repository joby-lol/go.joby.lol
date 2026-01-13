# Set up base image
FROM php:8.4-apache
RUN a2enmod rewrite

# Copy only what is necessary for production
COPY html/ /var/www/html/
