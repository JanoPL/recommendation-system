FROM php:8.1-cli as preparation
LABEL authors="JanoPL"

RUN mkdir -p /app
COPY ./../. /app
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions
RUN install-php-extensions xdebug mbstring curl

FROM preparation as build
COPY --from=preparation /app /app
WORKDIR /app
RUN composer install

FROM build as test
COPY --from=build /app /app
CMD ["composer", "test"]