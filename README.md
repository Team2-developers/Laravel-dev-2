# Laravel-dev-2


composer install
php artisan key:generate
docker-compsoe up -d --build

cd laravel-project

php artisan migrate
php artisan db:seed

php artisan migrate:rollback
php artisan db:seed --class=ImagesTableSeeder
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed --class=LifeSeeder
php artisan db:seed --class=CellSeeder
php artisan db:seed --class=CommentSeeder 
php artisan db:seed --class=NotificationSeeder
php artisan db:seed --class=GameEventsTableSeeder