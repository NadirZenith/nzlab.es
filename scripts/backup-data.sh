#!/usr/bin/env sh

#rsync -av nzlabes:/srv/nzlab.es/master/web/uploads php/srv/symfony/web/uploads


#. .env && echo ${MYSQL_PASSWORD}
#DIR="${pwd}/.env"
#echo $DIR
#cat ".env"





MYSQL_PASSWORD=$(grep MYSQL_PASSWORD .env | xargs)
IFS='=' read -ra MYSQL_PASSWORD <<< "$MYSQL_PASSWORD"
MYSQL_PASSWORD=${MYSQL_PASSWORD[1]}

echo $MYSQL_PASSWORD


#ssh nzlabes "
#mkdir -p $destination_dir;
#cd $destination_dir;
#git checkout $branch;
#git pull origin $branch;
#sh ./deploy/deploy.sh $env;
#exit"
