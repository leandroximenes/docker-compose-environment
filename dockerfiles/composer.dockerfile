FROM composer:2

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

# MacOS staff group's gid is 20, so is the dialout group in alpine linux. We're not using it, let's just remove it.
RUN delgroup dialout

ENV HTTPS_PROXY="http://rco:rco@10.67.28.12:3128"
ENV HTTP_PROXY="http://rco:rco@10.67.28.12:3128"
ENV FTP_PROXY="http://rco:rco@10.67.28.12:3128"
ENV NO_PROXY="localhost, 127.0.0.0/8, ::1, 10.0.0.0/8, *.eb.mil.br"

RUN addgroup -g ${GID} --system laravel
RUN adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel

WORKDIR /var/www/html
