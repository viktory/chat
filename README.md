Chat
======================
Instalation
-------------------------------------
1. Clone the repo
```git clone git@github.com:viktory/chat.git```
2. Run composer install
```composer install```
3. Edit `.env` file
4. Generate a new application key
```php artisan key:generate```
5. Run migrations and seeds
```php artisan migrate;php artisan db:seed```
6. Install gulp and Elixir. Be sure that node.js is installed
```npm install gulp;npm install```
7. Run gulp ```gulp```
8. Run WebSocket Server
```php artisan wschat:start```
9. Enjoy :)


Credentials for admin account
-------------------------------------
username - Admin
email - admin@email.com
password - 123123