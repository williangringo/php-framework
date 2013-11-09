#!/bin/bash

# variables definition
MAIL_TO="support@localhost"
APP_DIR=`pwd`

# creating directory if doesn't exist
if [ ! -d "$APP_DIR/$1" ]; then
    mkdir "$APP_DIR/$1"
fi

mv dist-staging.zip "$APP_DIR/$1"
cd "$APP_DIR/$1"
unzip -o dist-staging.zip
rm dist-staging.zip

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
