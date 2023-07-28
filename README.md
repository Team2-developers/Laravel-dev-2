# Laravel-dev-2


composer install
docker-compsoe up -d --build

cd laravel-project

php artisan migrate
php artisan migrate:rollback
php artisan db:seed --class=ImagesTableSeeder
php artisan db:seed --class=UsersTableSeeder
