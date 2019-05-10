git config --global push.default matching
git remote add deploy ssh://git@$IP:$PORT$DEPLOY_DIR
git push deploy master

ssh -i ./deploy_key travis@itstoni.com
ssh apps@$IP -p $PORT <<EOF
  cd $DEPLOY_DIR
  composer install
  yarn install
  yarn build
  ./bin/console doctrine:schema:update --force
  ./bin/console cache:clear
EOF
exit 0
