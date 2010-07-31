#!/bin/bash

USERNAME=$USER
GROUPNAME=$GROUPS
WWWUSER=`grep -m 1 www /etc/passwd | cut -d : -f 1`

sudo chown -R ${USERNAME}:${GROUPNAME} cache log data web

php symfony cc
git pull

sudo chmod -R 777 log/ cache/
sudo chown -R ${WWWUSER}:${WWWUSER} cache log data web
