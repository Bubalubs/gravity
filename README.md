[![Latest Stable Version](https://poser.pugx.org/bubalubs/gravity/v/stable)](https://packagist.org/packages/bubalubs/gravity)
[![License](https://poser.pugx.org/bubalubs/gravity/license)](https://packagist.org/packages/bubalubs/gravity)

Gravity is a Laravel package that sets up a flexible CMS with an admin control panel

# Installation

Install using composer

`composer require bubalubs/gravity`

Create database tables by running migrations

`php artisan migrate`

Publish CSS/JS files for admin control panel

`php artisan vendor:publish --tag=public`

# Customizing Views

Publish view files to your laravel view directory then edit them to make changes

`php artisan vendor:publish --provider=Bubalubs\LaravelGravity\LaravelGravityServiceProvider`

# Updating

Update to the latest views (This will overwrite any changes you have made)

`php artisan vendor:publish --tag=public --force`
