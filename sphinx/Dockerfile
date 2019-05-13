FROM ubuntu:18.04

ENV DEBIAN_FRONTEND noninteractive
ENV TIMEZONE Atlantic/Canary

# Configure service timezone
RUN ln -snf /usr/share/zoneinfo/$TIMEZONE /etc/localtime && \
    echo $TIMEZONE > /etc/timezone

# Install service dependencies
RUN apt update && apt -y install ca-certificates nginx python-pip texlive-latex-recommended

# Install python pip and python packages
RUN pip install --upgrade pip
RUN pip install --upgrade virtualenv
RUN pip install sphinx sphinx-autobuild recommonmark rst2pdf restructuredtext_lint sphinx_rtd_theme

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

# Forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/nginx/access.log
RUN ln -sf /dev/stderr /var/log/nginx/error.log

# Set working dir
WORKDIR /var/www/html

EXPOSE 80
EXPOSE 443

STOPSIGNAL SIGTERM

CMD ["nginx", "-g", "daemon off;"]
