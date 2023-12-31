FROM php:8.1-cli as preparation
LABEL authors="JanoPL"

ARG username
ARG uid
ARG gid
RUN (groupadd --gid $gid "$username" || groupadd "$username" || true) && (useradd  -l -m -s "/bin/bash" --gid "$username" --comment '' --uid $uid "$username" || useradd  -l -m -s "/bin/bash" --gid "$username" --comment '' "$username" || useradd  -l -m -s "/bin/bash" --gid "$gid" --comment '' "$username" || useradd -l -m -s "/bin/bash" --comment '' $username )

# for case when dist package was missing
RUN apt-get update && apt-get install -y git

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions
RUN install-php-extensions xdebug mbstring curl

USER $username
RUN mkdir -p /home/$username/app
COPY ./../. /home/$username/app

FROM preparation as build
USER $username

COPY --from=preparation /home/$username/app /home/$username/app
WORKDIR /home/$username/app
RUN composer install

FROM build as test
USER $username

COPY --from=build /home/$username/app /home/$username/app
CMD ["composer", "test"]