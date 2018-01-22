#!/usr/bin/env bash

export MYSQL_PWD=root
mysql -uroot <<MYSQL_SCRIPT
CREATE DATABASE IF NOT EXISTS purchase_sale DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
CREATE DATABASE IF NOT EXISTS purchase_sale_tests DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
CREATE USER IF NOT EXISTS 'dev'@'%' IDENTIFIED BY 'dev';
GRANT ALL PRIVILEGES ON purchase_sale.* TO 'dev'@'%';
GRANT ALL PRIVILEGES ON purchase_sale_tests.* TO 'dev'@'%';
FLUSH PRIVILEGES;
MYSQL_SCRIPT
sudo service mysql restart

echo 'Initializing project, please wait...'
echo '===================================='
cd /var/www
php init --env=Vagrant

if [ -e composer.phar ]
then
    php composer.phar self-update
else
    php -r "readfile('https://getcomposer.org/installer');" | php
fi

echo 'Initialization finished!'
echo -e 'Please run
\033[0;33mphp composer.phar global require "fxp/composer-asset-plugin:^1.4.0"\033[1;32m
\033[0;33mphp composer.phar install\033[1;32m
\033[0;33mphp yii migrate\033[1;32m
\033[0;33mphp yii fixture/load "*"[1;32m
\033[1;32m vendor/bin/codecept build[1;32m
\033[1;32m vendor/bin/codecept run[1;32m
\033[1;32mmanually in project root to finish installation'