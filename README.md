# IWA API

Laravel API and dashboard for IWA

PHP         8.3.3
Laravel     10.47.0

Delete semicolon from php.ini at folowing line:
 - ;extension=zip

Cd into IWA-API and run:
 - composer install

Then type the following commands:
 - php artisan key:generate
 - php artisan cache:clear
 - php artisan config:clear

To start the server:
 - php artisan serve

Development server will be available on: 
 - localhost:8000



