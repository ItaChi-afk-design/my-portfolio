FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

FROM php:8.2-cli-alpine

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

COPY . .
COPY --from=frontend /app/public/build ./public/build

RUN composer dump-autoload --no-dev --optimize --no-interaction \
    && chmod -R ug+rwx storage bootstrap/cache

ENV APP_ENV=production
ENV LOG_CHANNEL=stderr
ENV PORT=10000

EXPOSE 10000

CMD ["sh", "-c", "if [ \"${CONTACT_EMAIL_VERIFICATION:-false}\" = \"true\" ]; then php artisan migrate --force; fi; exec php -S 0.0.0.0:${PORT:-10000} -t public"]
