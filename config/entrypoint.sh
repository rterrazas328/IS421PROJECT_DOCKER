#!/bin/bash

set -e

if [ -e /run/secrets/laravel_app_key ]; then
  export APP_KEY=$(cat /run/secrets/laravel_app_key)
fi
if [ -e /run/secrets/db_password ]; then
  export DB_PASSWORD=$(cat /run/secrets/db_password)
fi
if [ -e /run/secrets/email_key ]; then
  export EMAIL_KEY=$(cat /run/secrets/email_key)
fi
if [ -e /run/secrets/email_password ]; then
  export EMAIL_PASSWORD=$(cat /run/secrets/email_password)
fi


#echo "Waiting for MySQL to be ready..."
# Wait until MySQL responds
#until php -r "
#\$mysqli = new mysqli(getenv('DB_HOST'), getenv('DB_USERNAME'), getenv('DB_PASSWORD'));
#if (\$mysqli->connect_errno) { exit(1); }
#" >/dev/null 2>&1; do
#  
#  php -r 'echo "host: " . getenv("MYSQL_USER");'
#  echo "MySQL is unavailable - sleeping"
#  sleep 2
#done


echo "MySQL is up - running migrations..."

php artisan migrate


exec apache2-foreground