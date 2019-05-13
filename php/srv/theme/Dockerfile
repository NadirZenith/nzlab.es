FROM ubuntu:18.04

ENV DEBIAN_FRONTEND noninteractive
ENV TIMEZONE Atlantic/Canary

# Configure service timezone
RUN ln -snf /usr/share/zoneinfo/$TIMEZONE /etc/localtime && \
    echo $TIMEZONE > /etc/timezone

# Install service dependencies
RUN apt update && apt -y install \
    ca-certificates \
    iproute2 \
    nginx \
    nodejs \
    npm \
    php7.2 \
    php7.2-common \
    php7.2-cgi \
    php7.2-fpm \
    php7.2-intl \
    php7.2-json \
    php-xdebug \
    php-xml

# If you need to connect from a docker container to something running on
# the local host, it can be a bit of a pain on Linux. On windows & Mac, there’s
# a special DNS entry ‘host.docker.internal’ which always points to the host
# machine. However that isn’t available on Linux (here’s a bug open for this as
# of May 2018: https://github.com/docker/for-linux/issues/264)
#
# That bug report also contains a pretty good solution for this problem, so to
# save you wading through, simply add the following line to your docker file:
#
# The following command adds an entry to the container’s Host file, so
# host.docker.internal will resolve to your host just like it does on Mac/
# Windows.
RUN ip -4 route list match 0/0 | awk '{print $3 "host.docker.internal"}' >> /etc/hosts

# Configure nginx
RUN chown -R www-data:www-data /var/lib/nginx
RUN rm -v /etc/nginx/nginx.conf && \
    rm -v /etc/nginx/mime.types && \
    rm -v /etc/nginx/sites-enabled/default && \
    rm -v /etc/nginx/sites-available/default

ADD etc/nginx/nginx.conf /etc/nginx/nginx.conf
ADD etc/nginx/mime.types /etc/nginx/mime.types
ADD etc/nginx/sites-available/default.conf /etc/nginx/sites-available/default.conf

RUN ln -snf /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default.conf

# Configure PHP
ADD etc/php/7.2/mods-available /etc/php/7.2/mods-available
ADD etc/php/7.2/fpm /etc/php/7.2/fpm
ADD etc/php/7.2/php.ini /etc/php/7.2/php.ini

# Forward request and error logs to docker log collector
RUN ln -snf /dev/stdout /var/log/php7.2-fpm.log
RUN ln -snf /dev/stdout /var/log/nginx/access.log
RUN ln -snf /dev/stderr /var/log/nginx/error.log

# Forward request and error logs to docker log collector
#ADD dist /var/www/html

EXPOSE 80
EXPOSE 443
EXPOSE 9999

STOPSIGNAL SIGTERM

ADD etc/startup.sh /usr/src/startup.sh
RUN chmod +x /usr/src/startup.sh
ENTRYPOINT /usr/src/startup.sh
