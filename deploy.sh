git pull
composer install

./reloadenv.sh

systemctl restart nginx
systemctl restart php-fpm
systemctl restart supervisord
systemctl status supervisord
git config credential.helper 'cache --timeout=60000'
