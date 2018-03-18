#!/bin/sh


#chown -R www-data:www-data /var
#ln -sf /usr/bin/node bin/node
#ln -sf /usr/bin/npm bin/npm
#ln -sf /usr/local/bin/php bin/php

#php bin/console cache:clear
#composer install;
#sh deploy/deploy.sh test
#chmod -R 777 var/cache;
#chmod -R 777 var/logs;

# default TESTING to false
${TESTING:=0}
if [ "$TESTING" = "0" ]
then
    # not testing, start php-fpm
    php-fpm;
else
    # run tests
    ./bin/phpunit

    # test with selenium-chrome
    php-fpm -D && ./bin/phpunit --group mink
fi

