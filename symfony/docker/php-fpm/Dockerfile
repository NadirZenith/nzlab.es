FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    gcc \
    # for assets (installed from source)
#    node \
#    npm \
#**
    git \
    #oracle
#    libaio-dev \
    zip \
    unzip \
    # for gd
    libpng-dev \
    # for assets compilation with yuicompressor
#    openjdk-7-jre \
    && rm -rf /var/lib/apt/lists/*

# java
# **
#ENV JAVA_HOME /usr/lib/jvm/java-7-openjdk-amd64

RUN curl -fsS -o /tmp/icu.tgz -L http://download.icu-project.org/files/icu4c/59.1/icu4c-59_1-src.tgz \
  && tar -zxf /tmp/icu.tgz -C /tmp \
  && cd /tmp/icu/source \
  && ./configure --prefix=/usr/local \
  && make \
  && make install \
# just to be certain things are cleaned up
  && rm -rf /tmp/icu*

# PHP_CPPFLAGS are used by the docker-php-ext-* scripts
ENV PHP_CPPFLAGS="$PHP_CPPFLAGS -std=c++11"

RUN docker-php-ext-configure intl --with-icu-dir=/usr/local && \
    docker-php-ext-install intl pdo pdo_mysql opcache gd sockets zip bcmath

#RUN apt-get install -y \
#    && docker-php-ext-install pdo pdo_mysql opcache gd sockets

# **
# xdebug
#RUN pecl install xdebug-2.5.0 \
#    && docker-php-ext-enable xdebug

##apcu
#RUN pecl install apcu-4.0.10 \
#    && docker-php-ext-enable \
#    apcu

# OCI
#COPY ./opt/oracle/instantclient-basic-linux.x64-12.2.0.1.0.zip /opt/oracle/
#COPY ./opt/oracle/instantclient-sdk-linux.x64-12.2.0.1.0.zip /opt/oracle/

#RUN unzip /opt/oracle/instantclient-basic-linux.x64-12.2.0.1.0.zip -d /opt/oracle \
#    && unzip /opt/oracle/instantclient-sdk-linux.x64-12.2.0.1.0.zip -d /opt/oracle \
#    && ln -s /opt/oracle/instantclient_12_2/libclntsh.so.12.1 /opt/oracle/instantclient_12_2/libclntsh.so \
#    && ln -s /opt/oracle/instantclient_12_2/libclntshcore.so.12.1 /opt/oracle/instantclient_12_2/libclntshcore.so \
#    && ln -s /opt/oracle/instantclient_12_2/libocci.so.12.1 /opt/oracle/instantclient_12_2/libocci.so \
#    && rm -rf /opt/oracle/*.zip
#
#RUN echo 'instantclient,/opt/oracle/instantclient_12_2/' | pecl install oci8-2.0.12 \
#    && docker-php-ext-configure pdo_oci --with-pdo-oci=instantclient,/opt/oracle/instantclient_12_2,12.1 \
#    && docker-php-ext-install \
#            pdo_oci \
#    && docker-php-ext-enable \
#            oci8



# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN usermod -u 1000 www-data
RUN useradd -ms /bin/bash dev
RUN usermod -u 1000 dev

USER dev

# **
RUN composer --version

# **
RUN echo 'alias sf="php app/console"' >> ~/.bashrc
RUN echo 'alias sf3="php bin/console"' >> ~/.bashrc

USER root

ADD start.sh /start.sh

WORKDIR  "/application"

ENTRYPOINT ["/start.sh"]

# ** move to dev container