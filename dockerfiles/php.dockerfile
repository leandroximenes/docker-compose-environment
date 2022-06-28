FROM php:8-fpm-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

ENV HTTPS_PROXY="http://rco:rco@10.67.28.12:3128"
ENV HTTP_PROXY="http://rco:rco@10.67.28.12:3128"
ENV FTP_PROXY="http://rco:rco@10.67.28.12:3128"
ENV NO_PROXY="localhost, 127.0.0.0/8, ::1, 10.0.0.0/8, *.eb.mil.br"

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

RUN addgroup -g ${GID} --system laravel
RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel

RUN sed -i "s/user = www-data/user = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = laravel/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

RUN apk update
RUN apk add libpq-dev poppler poppler-utils

RUN docker-php-ext-install pdo pdo_pgsql

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
