#!/usr/bin/env sh

ssh nzpro "
cd services/nzlab.es/;
git pull;
docker-compose down;
docker-compose up --build -d;
exit"
