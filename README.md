# soldier-app-api
An api using Lumen framework, in order to provide soldier data and show it all on a wallboard.

## Requirements
- PHP >= 7.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Composer installed
- MySQL >= 5.6

## Installation
- Clone this repository and then run command
```
composer install
```
- Set the configuration of database in .env file as the following
```
DB_CONNECTION=mysql
DB_HOST=<dbhost>
DB_PORT=<dbport>
DB_DATABASE=<dbname>
DB_USERNAME=<dbuser>
DB_PASSWORD=<dbpass>
```
- Migrate the database
```
php artisan migrate
```
- Run this api locally with command
```
php -S localhost:>port> -t public
