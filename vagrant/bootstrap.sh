#!/bin/bash

apt-get update
apt-get install -y vim git curl wget

apt-get install -y apt-transport-https lsb-release ca-certificates
wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg

sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'

apt-get update
apt-get install -y mysql-server nginx php-fpm php-mysql php-curl php-json php-gd php-mcrypt php-intl php-mbstring php-redis php-xml php-zip php-bcmath

rm /etc/nginx/sites-enabled/default
cp /vagrant/vagrant/symfony.conf /etc/nginx/sites-enabled
sudo service nginx restart

cd /tmp
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

echo "update user set plugin='' where User='root';"|mysql -uroot mysql
echo "flush privileges;"|mysql -uroot mysql