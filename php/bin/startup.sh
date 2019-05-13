#!/bin/bash


chmod -R 777 /srv/symfony/app/cache/
chmod -R 777 /srv/symfony/app/logs/

su -c "cd /srv/symfony/ && ./bin/deploy.sh ${PACKAGE_ENV}" - dev

#cd /srv/symfony/
#composer install;

#run bin/deploy.sh ${SYMFONY_ENV}
#chown -R www-data:www-data /srv/symfony/app/cache/
#chown -R www-data:www-data /srv/symfony/app/logs/
#chown -R www-data:www-data /srv/symfony/app/cache/sessions/
#chown -R www-data:www-data /srv/symfony/app/cache/${SYMFONY_ENV}/

#cd /var/www/wordpress/
#ln -sfn ../symfony/app/wp/wp-config.php wp-config.php
#ln -sfn ../symfony/app/wp/index.php index.php
#
#cd wp-content/
#ln -sfn ../../symfony/app/wp/mu-plugins mu-plugins
#ln -sfn ../../symfony/app/wp/plugins plugins
#ln -sfn ../../symfony/app/wp/themes themes

##chown -R www-data:www-data /var/www/wordpress/wp-content/

#printenv;

php-fpm;

