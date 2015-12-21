# Laravel Customer Support
This package will allow you to add a full customer support system into your Laravel application.

## Leave some feedback
[How are you using laravel-customer-support?](https://github.com/khachik1990)

## Features

## Installation (Laravel 5.x)
In composer.json:

    "require": {
        "webwork/customersupport":"1.0"
    }

Run:

    composer update

Add the service provider to `config/app.php` under `providers`:

    'providers' => [
        Webwork\Customersupport\CustomersupportServiceProvider::class,
    ]

Publish Assets

	php artisan vendor:publish --provider="Webwork\Customersupport\CustomersupportServiceProvider"
	
Update config file to reference your User Model:

	config/customersupport.php
	
Migrate your database:

    php artisan migrate
	

## Examples
* [Controller](https://github.com/khachik1990/laravel-customer-support/tree/master/src/Webwork/Customersupport/examples/TicketsController.php)
* [Routes](https://github.com/khachik1990/laravel-customer-support/tree/master/src/Webwork/Customersupport/examples/routes.php)
* [Views](https://github.com/khachik1990/laravel-customer-support/tree/master/src/Webwork/Customersupport/examples/views)

__Note:__ These examples use the [laravelcollective/html](http://laravelcollective.com/docs/5.0/html) package that is no longer included in Laravel 5 out of the box. Make sure you require this dependency in your `composer.json` file if you intend to use the example files.

## Example Projects
* [Customer support project](https://github.com/khachik1990/laravel-customer-support-demo-project)

## Security

If you discover any security related issues, please email [Khachik Tadevosyan](mailto:tadevosyan.khachik@gmail.com) instead of using the issue tracker.

## Credits

- [Khachik Tadevosyan](https://github.com/khachik1990)