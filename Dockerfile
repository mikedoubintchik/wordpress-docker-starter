FROM wordpress:6.0.2

# Install server packages
RUN apt-get update && apt-get install vim -y

# Install WP CLI
COPY --from=wordpress:cli /usr/local/bin/wp /usr/bin/wp

# Copy files
COPY wp-content /var/www/html/wp-content

RUN chown www-data:www-data /var/www/html/wp-content

# Applying the execution right on the folders for apache
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT [ "/entrypoint.sh" ]

CMD ["apache2-foreground"]

# Updating the configuration of wordpress image with our own
COPY .dev/config/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

EXPOSE 80 443

# Health check
# HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1/wp-login.php
