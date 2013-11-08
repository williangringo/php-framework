#!/bin/bash

# change the url below and if possible, use ssh keys for git authentication
GIT_URL="https://user:pass@my-git-server/project/name.git"

# variables definition
MAIL_TO="support@localhost"
APP_DIR=`pwd`

# cloning only if the directory doesn't exist
if [ ! -d "$APP_DIR/$1" ]; then
    git clone $GIT_URL $1
fi

# ensure we're in the master branch and it's the lastest data
cd $1
git checkout master
git pull
cd ..

# symlinking the shared folder (with images, videos, ...)
if [ -d "$APP_DIR/shared" ]; then
    ln -s "$APP_DIR/shared" "$APP_DIR/$1/www/media" 
fi

# changing the symlink for the current live application (apache's DocumentRoot location)
ln -sfn "$APP_DIR/$1" "$APP_DIR/current"

# reloading apache
service apache2 reload

# removing cache directory
if [ -d "/tmp/$2" ]; then
    rm -Rf "/tmp/$2"
fi

# create a dumb file to force apache reload if unsuccessful in the command above
touch /tmp/a2r.txt

# send a mail message if available
if [ -L "/usr/bin/mailx" ]; then
    mailx -s "Deploy STAGING $1 > $2 - OK" < /dev/null "$MAIL_TO"
fi

# remove the this script in the end
rm $0