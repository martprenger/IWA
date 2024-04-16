# IWA API

Laravel API and dashboard for IWA

PHP         8.3.3
Laravel     10.47.0

Delete semicolon from php.ini at following line:
 - ;extension=zip

Cd into IWA-API and run:
 - composer install

Then type the following commands:
 - php artisan key:generate
 - php artisan cache:clear
 - php artisan config:clear

To load all IWA data into database:
 - php artisan migrate
 - php artisan db:seed --class=countrySeeder
 - php artisan db:seed --class=stationSeeder
 - php artisan db:seed --class=geolocationSeeder
 - php artisan db:seed --class=nearestlocationSeeder
 - php artisan db:seed --class=UserSeeder

To start the server:
 - php artisan serve

Development server will be available on: 
 - localhost:8000



