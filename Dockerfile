FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    nginx git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --optimize-autoloader --no-dev

COPY .env.example .env
RUN php artisan key:generate

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

RUN echo 'server { \
    listen 80; \
    root /var/www/html/public; \
    index index.php; \
    location / { try_files $uri $uri/ /index.php?$query_string; } \
    location ~ \.php$ { fastcgi_pass 127.0.0.1:9000; fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name; include fastcgi_params; } \
}' > /etc/nginx/sites-available/default

RUN echo '#!/bin/bash\nphp-fpm -D\nnginx -g "daemon off;"' > /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]