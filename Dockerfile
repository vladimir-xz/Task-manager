FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev
RUN docker-php-ext-install pdo pdo_pgsql zip


RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs
RUN pecl install excimer

WORKDIR /app

COPY . .

ENV ASSET_URL https://your-app.herokuapp.com


RUN composer install
RUN npm ci
RUN npm run build

CMD ["bash", "-c", "php artisan sentry:publish --dsn=https://1cf61a24ff4eb3c6c6eb523621446a6b@o4507619336388608.ingest.de.sentry.io/4507676053274704", "php artisan migrate:refresh --force --seed && php artisan serve --host=0.0.0.0 --port=$PORT"]