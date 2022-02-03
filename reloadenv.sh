chmod 777 .env
rm bootstrap/cache/config.php
php artisan config:cache
php artisan config:clear
php artisan cache:clear
php artisan config:cache
composer dump-autoload