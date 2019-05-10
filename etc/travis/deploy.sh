#!/bin/bash

ssh -i ./deploy_key travis@$IP -p $PORT <<EOF
  git pull origin master
  cd $DEPLOY_DIR
  composer install --ansi
  yarn install
  yarn build
  ./bin/console doctrine:schema:update --force
  ./bin/console cache:clear
EOF

exit 0
