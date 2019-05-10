#!/bin/bash

ssh -i ./deploy_key travis@$IP -p $PORT <<EOF
  cd $DEPLOY_DIR
  git pull origin master
  composer install --ansi
  yarn install
  yarn build
  ./bin/console doctrine:query:sql 'CREATE EXTENSION IF NOT EXISTS "uuid-ossp"'
  ./bin/console doctrine:database:create --if-not-exists
  ./bin/console doctrine:schema:update --force
  ./bin/console cache:clear
EOF

exit 0
