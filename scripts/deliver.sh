#!/usr/bin/env sh

ssh nzpro "
cd services/nzlab.es/;
docker-compose down;
git pull;
docker-compose up --build -d;
exit"
