#!/usr/bin/env bash

. $(dirname "$0")/functions.sh


#Check parameters
if [ $# -eq 0 ] || [[ "$1" != "master" ]] && [[ "$1" != "pre" ]]
then
    display_error "You must set a branch to deliver (master/pre)"
    die
else
    branch=$1
    display_info "Trying to deliver branch: $branch"
fi

env="dev"
if [[ "$branch" == "master" ]]
then
    env="prod"
fi

base_dir='/srv/nzlab.es'
destination_dir="$base_dir/$1"

display_info "Delivering here: $destination_dir"
display_info "branch: $branch"
display_info "environment: $env"

#die
ssh nzlabes "
mkdir -p $destination_dir;
cd $destination_dir;
git checkout $branch;
git pull origin $branch;
sh ./deploy/deploy.sh $env;
exit"


display_info "Finished deliver"


