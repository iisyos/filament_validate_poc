# filament_validate_poc

## What is this?

This repository has been created to demonstrate a specific issue found in the Filament. The core focus is on the non-functioning `:date` placeholder in Filament's validation messages, which contrasts with its expected behavior in Laravel's native validation system.

## How to Setup
Setting Up Laravel with Sail
Follow the steps in the Laravel documentation to set up a new Laravel project using Sail:

```bash
# curl -s "https://laravel.build/example-app" | bash
cd example-app
./vendor/bin/sail up
```
Install Filament by running the following command:

```bash
composer require filament/filament:"^3.2" -W
php artisan filament:install --panels
php artisan migrate
php artisan make:filament-user
# Enter details when prompted: 
# Name: admin, Email: admin@example.com, Password: password
```

Creating a User Resource
Generate a User Resource for Filament:
```bash
php artisan make:filament-resource User
```

## Phenomenon
Laravel's validation messages can utilize placeholders. For example, if there is a `start` field with a rule `before:end`, the message format used would be:

> "The :attribute field must be a date before :date."

 If `start` is later than `end`, the resulting message would be

> "The start field must be a date before end."
In raw Laravel, this is achieved using the Validator facade as follows:

```php
$validator = Validator::make([
    'start' => '2021-01-02',
    'end' => '2021-01-01',
], [
    'start' => 'before:end',
]);
```

It's also possible to customize the field names start and end:

```php
$validator = Validator::make([
    'start' => '2021-01-02',
    'end' => '2021-01-01',
], [
    'start' => 'before:end',
], [], [
    'start' => 'day1',
    'end' => 'day2',
]);
```

In this case, the output message would be:

> "The day1 field must be a date before day2."

To achieve a similar outcome in Filament within a Resource, you can use the following code:

```php
use Filament\Forms;
use Filament\Forms\Form;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\DatePicker::make('start')
                ->label('day1')
                ->validationAttribute('day1')
                ->required()
                ->rule('before:end'),
            Forms\Components\DatePicker::make('end')
                ->label('day2')
                ->validationAttribute('day2')
                ->required(),
        ]);
}
```
However, the resulting message in Filament would be:

> "The day1 field must be a date before end."

This indicates that the placeholder for the `:date` in Laravel's validation messages is not being utilized as expected in Filament. 





