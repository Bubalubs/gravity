[![Latest Stable Version](https://poser.pugx.org/bubalubs/gravity/v/stable)](https://packagist.org/packages/bubalubs/gravity)
[![License](https://poser.pugx.org/bubalubs/gravity/license)](https://packagist.org/packages/bubalubs/gravity)

Gravity is a Laravel package that sets up a light flexible CMS with an admin control panel

# Installation

Install using composer

`composer require bubalubs/gravity`

Create database tables by running migrations

`php artisan migrate`

Publish CSS/JS files for admin control panel

`php artisan vendor:publish --tag=public`

Add the HasRoles Trait to your User model

```
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    ...
```

# Entities (Models)

Entities allow you to work with a custom Laravel model and adds CRUD options to the admin.

To work with images on an entity your model must implement the following interface and trait:

```
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class YourModel extends Model implements HasMedia
{
    use HasMediaTrait;
    
    ...
```

# Customizing Views

Publish view files to your laravel view directory then edit them to make changes

`php artisan vendor:publish --provider=Bubalubs\Gravity\GravityServiceProvider`

# Updating

Update to the latest views (This will overwrite any changes you have made)

`php artisan vendor:publish --provider=Bubalubs\Gravity\GravityServiceProvider --tag=public --force`

# Thanks

Thanks to [spatie](https://spatie.be/open-source) for their awesome libraries that this package relies on for permissions, media library and menu html generator!