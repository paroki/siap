ssh -i ./deploy_key travis@itstoni.com
echo $PWD
git pull origin master
composer install
yarn install
yarn build
./bin/console doctrine:schema:update --force
./bin/console cache:clear

exit 0
