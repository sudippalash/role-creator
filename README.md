## role-creator comes to Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


`role-creator` is a role management package of `Laravel` that provides options to manage role.

Note: This package is wrapper of `spatie/laravel-permission` package.

## Install

Via Composer

```bash
composer require sudippalash/role-creator
```

#### Publish config, migration & seeds files

You should publish the migration files, the config/permission.php, config/role-creator.php config file and PermissionSeeder file with:

```bash
php artisan vendor:publish --provider="Sudip\RoleCreator\Providers\AppServiceProvider"
```

For `config/permission.php` config file you should check `spatie/laravel-permission` package documentation.

In `config/role-creator.php` config file you should set your data.

```php
    return [
        /*
        |--------------------------------------------------------------------------
        | Extends Layout Name
        |--------------------------------------------------------------------------
        |
        | Your main layout file path name. Example: layouts.app
        | 
        */

        'layout_name' => 'layouts.app',
        
        /*
        |--------------------------------------------------------------------------
        | Section Name
        |--------------------------------------------------------------------------
        |
        | Your section name which in yield in main layout file. Example: content
        | 
        */

        'section_name' => 'content',

        /*
        |--------------------------------------------------------------------------
        | Route Name, Prefix & Middleware
        |--------------------------------------------------------------------------
        |
        | Provide a route name for role route. Example: user.role
        | Provide a prefix name for role url. Example: user/role
        | If role route use any middleware then provide it or leave empty array. Example: ['auth '] 
        */

        'route_name' => 'user.role',
        'route_prefix' => 'user/role',
        'middleware' => [],

        /*
        |--------------------------------------------------------------------------
        | Auth Guard Name
        |--------------------------------------------------------------------------
        |
        | Which authentication guard you use for role. Example: web or admin
        | 
        */

        'auth_guard_name' => 'web',

        /*
        |--------------------------------------------------------------------------
        | Bootstrap version
        |--------------------------------------------------------------------------
        |
        | Which bootstrap you use in your application. Example: 3 or 4 or 5
        | 
        */

        'bootstrap_v' => 4,

        /*
        |--------------------------------------------------------------------------
        | CSS
        |--------------------------------------------------------------------------
        |
        | Add your css class in this property if you want to change design. 
        */

        'css' => [
            'container' => null,
            'card' => null,
            'input' => null,
            'btn' => null,
        ],
    ];
```

Clear your config cache. This package requires access to the permission config. Generally it's bad practice to do config-caching in a development environment. If you've been caching configurations locally, clear your config cache with either of these commands:

```bash
php artisan optimize:clear
# or
php artisan config:clear
```

Run the migrations: After the config and migration have been published and configured, you can create the tables for this package by running:

```bash
php artisan migrate
```

In `database/seeders/PermissionSeeder.php` seed file you should set your permission data and then run the seed with this command:

```bash
php artisan db:seed --class=PermissionSeeder
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sudippalash/role-creator?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sudippalash/role-creator?style=flat-square
[ico-license]: https://img.shields.io/github/license/sudippalash/role-creator?style=flat-square
[link-packagist]: https://packagist.org/packages/sudippalash/role-creator
[link-downloads]: https://packagist.org/packages/sudippalash/role-creator
[link-author]: https://github.com/sudippalash
