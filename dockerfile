FROM ubuntu:18.04
ARG HTTP_PROXY="http://10.166.133.81:3128"
ARG NO_PROXY="localhost, 127.0.0.0/8, ::1, 10.0.0.0/8, *.eb.mil.br"

ENV HTTPS_PROXY ${HTTP_PROXY}
ENV HTTP_PROXY ${HTTP_PROXY}
ENV FTP_PROXY ${HTTP_PROXY}

ENV TZ=UTC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN echo "Acquire::https::Proxy \"$HTTP_PROXY\";" >> /etc/apt/apt.conf
RUN echo "Acquire::http::Proxy \"$HTTP_PROXY\";" >> /etc/apt/apt.conf
RUN echo "Acquire::ftp::Proxy \"$HTTP_PROXY\";" >> /etc/apt/apt.conf

RUN apt update && apt upgrade -y
RUN apt install apache2 apache2-utils -y
RUN apt-get update \
    && apt-get install -y libapache2-mod-php php-cli php-dev \
    php-pgsql php-sqlite3 php-gd php-curl php-bz2 php-memcached\
    php-imap php-mysql php-mbstring php-xml php-zip php-bcmath php-soap \
    php-intl php-readline php-ldap php-fpm php-msgpack php-igbinary php-redis \
    php-xdebug

COPY ./src /var/www/html

EXPOSE 80
ENTRYPOINT ["apache2ctl", "-D", "FOREGROUND"]

# CMD [“apache2ctl”, “-D”, “FOREGROUND”]
# USER www-data

# COPY src /var/www/html
