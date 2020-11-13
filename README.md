<a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a>

## How to install

Laravel:
1) Clone repo
2) Run command: composer install
3) Run command: npm run dev

MongoDB:

1) Create Starship-test db or change entry in config/database.php 99 'database' => env('DB_DATABASE', 'Starship-test'),
2) Create starships collection
3) Run command: php artisan db:seed
