FROM nginx:alpine

ENV TIMEZONE Atlantic/Canary

# Configure service timezone
RUN ln -snf /usr/share/zoneinfo/$TIMEZONE /etc/localtime && \
    echo $TIMEZONE > /etc/timezone

RUN rm -v /etc/nginx/conf.d/*
ADD nginx/etc/nginx/nginx.conf /etc/nginx/nginx.conf

ADD nginx/etc/nginx/sites-available/default.conf /etc/nginx/sites-available/default.conf
RUN mkdir -p /etc/nginx/sites-enabled/ && \
    ln -snf /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default.conf

# Forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

RUN mkdir -p /etc/nginx/certs

# this certificate files are *copied from letsencrypt
#
ADD /nginx/certs/fullchain.pem /etc/nginx/certs/fullchain.pem
ADD /nginx/certs/privkey.pem /etc/nginx/certs/privkey.pem

EXPOSE 80
