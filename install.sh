#!/bin/bash

echo "Installing dependencies"
sudo apt-get install php
sudo apt-get install php-curl
sudo apt-get install composer
composer install
echo "Done."
