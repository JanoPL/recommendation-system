FROM php:8.4-cli AS preparation
LABEL authors="JanoPL"

ARG username
ARG uid
ARG gid
RUN (groupadd --gid $gid "$username" || groupadd "$username" || true) && (useradd  -l -m -s "/bin/bash" --gid "$username" --comment '' --uid $uid "$username" || useradd  -l -m -s "/bin/bash" --gid "$username" --comment '' "$username" || useradd  -l -m -s "/bin/bash" --gid "$gid" --comment '' "$username" || useradd -l -m -s "/bin/bash" --comment '' $username )

# for case when dist package was missing
RUN apt-get update && apt-get install -y libzip-dev unzip

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions
RUN install-php-extensions mbstring curl zip

USER $username
RUN mkdir -p /home/$username/app
COPY --chown=$username ./../. /home/$username/app

FROM preparation AS build
USER $username

COPY --from=preparation /home/$username/app /home/$username/app
WORKDIR /home/$username/app
RUN composer install

FROM build AS test
USER $username

COPY --from=build /home/$username/app /home/$username/app
CMD ["composer", "test"]