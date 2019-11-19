#!/usr/bin/env sh

# delete all inside mysql data except .gitkeep
if [ -e 'volumes/mysql/data/db' ]
then
    ls -d  volumes/mysql/data/* | xargs rm -rf
fi


rm -rf php/srv/symfony/vendor

rm -rf php/srv/symfony/app/logs
rm -rf php/srv/symfony/app/cache