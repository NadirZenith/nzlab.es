FROM php:7.1-fpm

RUN apt-get update && apt-get install -y \
    gcc \
    git \
    zip \
    unzip \
    # for gd
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && rm -rf /var/lib/apt/lists/*
#     supervisor cron     libzip-dev libjpeg-dev libpng-dev net-tools iputils-ping \

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
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install intl pdo pdo_mysql opcache gd sockets zip bcmath && \
    docker-php-ext-install -j$(nproc) gd

# **
# xdebug
#RUN pecl install xdebug-2.5.0 \
#    && docker-php-ext-enable xdebug

##apcu
#RUN pecl install apcu-4.0.10 \
#    && docker-php-ext-enable \
#    apcu

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

#RUN usermod -u 1000 www-data
RUN useradd -ms /bin/bash dev
RUN usermod -u 1000 dev

USER dev

# **
RUN echo 'alias sf="php app/console"' >> ~/.bashrc
RUN echo 'alias sf3="php bin/console"' >> ~/.bashrc

USER root

ADD php/bin/startup.sh /startup.sh

#WORKDIR  "/srv"

ENTRYPOINT ["/startup.sh"]

