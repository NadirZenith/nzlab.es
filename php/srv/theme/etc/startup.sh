#!/bin/bash

#cd /app
#yarn install
#cp -r dist/* /var/www/html/
#npm install
#npm install -g grunt
#grunt build:all

# Start php-fpm
/etc/init.d/php7.2-fpm start

# Start nginx
nginx -g 'daemon off;'