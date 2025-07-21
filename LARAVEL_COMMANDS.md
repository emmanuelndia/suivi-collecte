# 🚀 LARAVEL – COMMANDES ESSENTIELLES

## 🔧 Installation & Démarrage
```bash
composer create-project laravel/laravel nom_du_projet
php artisan serve
php artisan key:generate


php artisan make:migration create_users_table
php artisan migrate
php artisan migrate:rollback
php artisan migrate:refresh
php artisan migrate:fresh --seed

php artisan make:seeder UserSeeder
php artisan db:seed
php artisan db:seed --class=UserSeeder
php artisan make:factory UserFactory


php artisan make:model Post
php artisan make:controller PostController
php artisan make:controller PostController --resource
php artisan make:request StorePostRequest

php artisan route:list
php artisan config:cache
php artisan route:cache
php artisan cache:clear
php artisan config:clear

php artisan make:test PostTest
php artisan test

composer require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run dev

composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev

php artisan tinker
php artisan storage:link
php artisan make:middleware AdminMiddleware
php artisan make:event PostCreated
php artisan make:listener SendEmailNotification
