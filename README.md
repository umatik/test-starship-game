<a href="https://laravel.com" target="_blank"><img src="https://jenssegers.com/static/media/l4mongo.png" width="400"></a>

## How to install

Laravel:
1) Clone repo
2) Run command: composer install

VUE:
1) Run command: npm install
2) Run command: npm run dev

MongoDB:
1) Create Starship-test db or change entry in config/database.php 99 'database' => env('DB_DATABASE', 'Starship-test'),
2) Create Starships collection
3) Run command: php artisan db:seed
