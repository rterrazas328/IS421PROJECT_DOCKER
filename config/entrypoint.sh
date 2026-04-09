#!/bin/bash

set -e

if [[ -v RAILWAY_SERVICE_ID ]]; then
    echo "Railway Detected!"
else
  if [ -e /run/secrets/laravel_app_key ]; then
    export APP_KEY=$(cat /run/secrets/laravel_app_key)
  fi
  if [ -e /run/secrets/db_database ]; then
    export DB_DATABASE=$(cat /run/secrets/db_database)
  fi
  if [ -e /run/secrets/db_username ]; then
    export DB_USERNAME=$(cat /run/secrets/db_username)
  fi
  if [ -e /run/secrets/db_password ]; then
    export DB_PASSWORD=$(cat /run/secrets/db_password)
  fi
  if [ -e /run/secrets/email_domain ]; then
    export EMAIL_DOMAIN=$(cat /run/secrets/email_domain)
  fi
  if [ -e /run/secrets/email_host ]; then
    export EMAIL_HOST=$(cat /run/secrets/email_host)
  fi
  if [ -e /run/secrets/email_key ]; then
    export EMAIL_KEY=$(cat /run/secrets/email_key)
  fi
  if [ -e /run/secrets/email_username ]; then
    export EMAIL_USERNAME=$(cat /run/secrets/email_username)
  fi
  if [ -e /run/secrets/email_password ]; then
    export EMAIL_PASSWORD=$(cat /run/secrets/email_password)
  fi
fi


echo "MySQL is up - running migrations..."

php artisan migrate


exec apache2-foreground