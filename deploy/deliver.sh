#!/usr/bin/env bash

#######################################################################
########################  FUNCTIONS  ##################################
#######################################################################
display_error () {
    echo -e "\033[33;31m[ERROR] $1 \033[0m"
}

display_success () {
    echo -e "\033[33;32m[OK] $1 \033[0m"
}

display_info () {
    echo -e "\033[33;33m[INFO] $1 \033[0m"
}

die () {
    exit 1
}
version_lt() { test "$(printf "$2\n$1" | sort -rV | head -n 1)" != "$1"; }
#######################################################################
###################### END FUNCTIONS  #################################
#######################################################################


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


