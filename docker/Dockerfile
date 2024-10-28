FROM composer/composer:latest-bin AS composer

FROM ghcr.io/shyim/wolfi-php/frankenphp:8.3 AS base
ARG UID=10001
ARG GID=10001
RUN <<SH
    set -eo pipefail
    set -x

    # Add www-data group and user.
    addgroup -g ${GID} -S www-data
    adduser -u ${UID} -D -S -G www-data www-data

    # Set volume permissions.
    mkdir -p /data /config /app/runtime && \
    chown -R www-data:www-data /data /config /app/runtime

    # Install extra packages.
    apk add --no-cache \
    php-frankenphp-8.3-opcache \
    php-frankenphp-8.3-mbstring \
    php-frankenphp-8.3-intl \
    php-frankenphp-8.3-dom \
    php-frankenphp-8.3-curl \
    php-frankenphp-8.3-phar \
    php-frankenphp-8.3-openssl \
    php-frankenphp-8.3-xml \
    php-frankenphp-8.3-xmlwriter \
    php-frankenphp-8.3-simplexml \
    php-frankenphp-8.3-pdo
SH

FROM base AS prod-builder
COPY --from=composer /composer /usr/bin/composer

COPY .. /app

RUN --mount=type=cache,target=/tmp/cache \
    <<SH
    set -eo pipefail
    set -x

    composer install --no-dev --no-progress --no-interaction --classmap-authoritative && \
    rm composer.lock composer.json
SH

FROM base AS prod
ENV YII_ENV=prod

COPY --from=prod-builder --chown=www-data:www-data /app /app
USER www-data

FROM base AS dev
RUN <<SH
    set -eo pipefail
    set -x

    # Install extra packages for dev only.
    apk add --no-cache \
    php-frankenphp-8.3-xdebug
SH

COPY --from=composer /composer /usr/bin/composer
USER www-data
