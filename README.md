## Recipes App

Laravel and Vue.js App for Recipes

Copy the .env.example file and rename it to .env

Create the database and populate the .env file with appropriate database details.

##### Basic

run `composer install`

run `php artisan key:generate`

run `php artisan migrate`

run `php artisan storage:link`

run `npm install`

run `php artisan serve`

run `npm run dev` to compile assets

run `npm run watch` command to monitor and automatically recompile your components each time they are modified

##### Admin

* Register a new account on http://127.0.0.1:8000
* Install admin panel and assign admin privileges to the user

```
php artisan voyager:install
php artisan voyager:admin your@email.com
```
