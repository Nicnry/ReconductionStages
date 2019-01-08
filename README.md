# LARASTA

"Stage" application with laravel.
For more information, please go to this [repo](https://github.com/XCarrel/larasta) 


## Install
1. Clone this repo.
2. Open Workbench model in 'database' folder and export the schema.
3. Set your new DB as default db.
4. Execute the sql file in 'database' folder.
5. Open your terminal and go :
```bash
cd /path/to/your/local/clone/of/larasta

# install composer dependencies
composer install

# install the npm dependencies
cd public && npm i
```
6. create .env file and add admin values :
```bash
USER_ID=1234
USER_INITIALS='ABC'
USER_LEVEL=1
```
7. If you don't use mysql 8, please go on 'config/database.php' and change this :
```php
'mysql' => [
  'driver' => 'mysql',
  'host' => env('DB_HOST', 'localhost'),
  'port' => env('DB_PORT', '3306'),
  'database' => env('DB_DATABASE', 'larasta'),
  'username' => env('DB_USERNAME', 'root'),
  'password' => env('DB_PASSWORD', 'root'),
  'unix_socket' => env('DB_SOCKET', ''),
  'charset' => 'utf8mb4',
  'collation' => 'utf8mb4_unicode_ci',
  'prefix' => '',
  'strict' => true,
  'engine' => null,
],
```
8. On your terminal, make `cd ..` and use `php artisan serve` enjoy !

