## Role Creator

![alt text](https://github.com/sudippalash/role-creator/blob/master/img.jpg?raw=true)


[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


`role-creator` is a role management package of `Laravel` that provides options to manage role for auth users.

Note: This package is wrapper of `spatie/laravel-permission` package.

## Install

Via Composer

```bash
composer require sudippalash/role-creator
```

### Publish config, migrations & seeders files


You should publish 

migrations files:
1. `database/migrations/create_permission_tables.php`
2. `database/migrations/add_module_column_to_permissions_table.php`, 

config files:
1. `config/permission.php`, 
2. `config/role-creator.php` 

and seeders file:
1. `database/seeders/PermissionSeeder.php` 

with:

```bash
php artisan vendor:publish --provider="Sudip\RoleCreator\Providers\AppServiceProvider" --tag=required
```

For `config/permission.php` file you should check `spatie/laravel-permission` package documentation.

This is the contents of the published config file `config/role-creator.php`:

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
        | Provide a route name for role route. Example: user.roles
        | Provide a prefix name for role url. Example: user/roles
        | If role route use any middleware then provide it or leave empty array. Example: ['auth '] 
        */

        'route_name' => 'user.roles',
        'route_prefix' => 'user/roles',
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
        | Flash Messages
        |--------------------------------------------------------------------------
        |
        | After Save/Update flash message session key name
        | 
        */

        'flash_success' => 'success',
        'flash_error' => 'error',

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
            'table' => null,
            'table_action_col_width' => null,
            'table_action_btn' => null,
        ],
    ];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --provider="Sudip\RoleCreator\Providers\AppServiceProvider" --tag=views
```

Optionally, you can publish the lang using

```bash
php artisan vendor:publish --provider="Sudip\RoleCreator\Providers\AppServiceProvider" --tag=lang
```

You should run the migrations with:

```bash
php artisan migrate
```

In `database/seeders/PermissionSeeder.php` seed file you should set your permission data and then you should run the seed with:

```bash
php artisan db:seed --class=PermissionSeeder
```

## Usage

You should copy the below line and paste in your project menu section

```bash
<a href="{{ route(config('role-creator.route_name') . '.index') }}">{{ trans('role-creator::sp_role_creator.roles') }}</a>
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sudippalash/role-creator?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sudippalash/role-creator?style=flat-square
[ico-license]: https://img.shields.io/github/license/sudippalash/role-creator?style=flat-square
[link-packagist]: https://packagist.org/packages/sudippalash/role-creator
[link-downloads]: https://packagist.org/packages/sudippalash/role-creator
[link-author]: https://github.com/sudippalash
