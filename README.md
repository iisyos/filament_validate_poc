# filament_validate_poc


## How to setup
Create Laravel project by sail referring to [this](https://laravel.com/docs/10.x/installation#sail-on-macos) page.

```
curl -s "https://laravel.build/example-app" | bash
cd example-app
./vendor/bin/sail up
```

Install filament by following command.
```bash
composer require filament/filament:"^3.2" -W
 
php artisan filament:install --panels

php artisan migrate

php artisan make:filament-user
# Name: admin
# Email: admin@example.com
# Password: password
```

Create `User` Resource.
```bash
php artisan make:filament-resource User
```