# MediLab Laravel Backend
Admin dashboard for the MediLab project built with Laravel.

## Admin Login
- Email: admin@example.com  
- Password: 12345678  
- URL: /admin/login

## How to Run
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve

