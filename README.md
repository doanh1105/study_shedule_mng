Chạy script để cài run project: <br>
cd quanly_lich_hoc<br>
composer install<br>
cp .env.example .env <br>
php artisan key:generate <br>
<br>
config database trong file .env
<br>Script:<br>
php artisan config:cache<br>
php artisan migrate<br>
php artisan serve<br>
