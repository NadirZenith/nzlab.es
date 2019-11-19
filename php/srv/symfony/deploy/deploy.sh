#!/usr/bin/env sh

. $(dirname "$0")/functions.sh

#Check parameters
if [ $# -eq 0 ]
then
    display_error "You must set an environment (dev|test|prod)"
    die
else
    display_success "Environment: $1"
fi

#Check php binary
#if [ ! -x 'bin/php' ]
#then
#    display_error "PHP CLI not found "
#    display_info "Do you forgot to create a link? (ln -s /usr/bin/php bin/php)"
#    die
#else
#    version=`bin/php -v | grep cli`
#    display_success "PHP found: $version"
#fi

#Check Composer binary
#if [ ! -x 'bin/composer' ]
#then
#    display_error "Composer not found at 'bin' folder"
#    display_info "Do you forgot to create a link? (ln -s /usr/local/bin/composer bin/composer)"
#    die
#else
#    version=`bin/composer -V`
#    display_success "Composer found: $version"
#fi

display_info 'Check for debug code'
dumps=`find src/ -type f -print0 | xargs -0 grep -l "dump("`
if [ ! -z "$dumps" ]
then
    display_error "Remove dump() function from: $dumps"
    die
else
    display_success "* dump() calls not found in src/"
fi

dumps=`find app/Resources/ -type f -print0 | xargs -0 grep -l "dump("`
if [ ! -z "$dumps" ]
then
    display_error "Remove dump() function from: $dumps"
    die
else
    display_success "* dump() calls not found in app/Resources/"
fi

#Check for .htaccess (apache only)
#if [ ! -e 'web/.htaccess' ]
#then
#    cp web/.htaccess.dist web/.htaccess
#    display_info ".htaccess generated"
#fi

#Check for robots.txt
if [ ! -e 'web/robots.txt' ]
then
    cp web/robots.txt.dist web/robots.txt
    display_info "robots.txt generated"
fi

#display_info 'Check for NPM updates'
#bin/npm update
#bin/npm list --depth=0

if [ $1 = 'dev' ]
then
    display_info 'Check for COMPOSER updates'
    export SYMFONY_ENV=dev
    composer install

    if [ ! -e 'web/app_dev.php' ]
    then
        cp web/app_dev.php.dist web/app_dev.php
        display_info "app_dev.php generated"
    fi

    display_success 'Upgrade database'
    php app/console doctrine:schema:update --dump-sql --force

#    display_success 'Generate ASSETS'
#    node node_modules/.grunt --force default

elif [ $1 = 'test' ]
then
    display_info 'Check for COMPOSER updates'
    export SYMFONY_ENV=test
    composer install

    display_success 'Upgrade database'
    php app/console doctrine:schema:update --dump-sql --force
    php app/console doctrine:fixtures:load --no-interaction

#    display_success 'Generate ASSETS'
#    node node_modules/.bin/grunt --force package

elif [ $1 = 'prod' ]
then
    display_info 'Check for COMPOSER updates'
    export SYMFONY_ENV=prod
    composer install --no-dev --optimize-autoloader

    display_success 'Upgrade database'
    php app/console doctrine:schema:update --dump-sql --force

#    display_success 'Generate ASSETS'
#    bin/node node_modules/.bin/grunt --force package

else
    display_error 'Environment does not exists'
    die
fi

display_success 'Done'