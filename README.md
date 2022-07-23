## role-creator comes to Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]


`role-creator` is a role management package of `Laravel` that provides options to manage role.

## Install

Via Composer

```bash
$ composer require sudippalash/role-creator
```

#### Publish config file

You will need to publish config file to add setting for `role-creator`.

```
php artisan vendor:publish --provider="Sudip\RoleCreator\Providers\AppServiceProvider" --tag=role-creator
```

In `config/role-creator.php` config file you should set `role-creator` global path.

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

        'route_name' => 'admin.role',
        'route_prefix' => 'admin/role',
        'middleware' => [],

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


#### Publish migration file

You will need to publish migration file to add field for `permissions` table.

```
php artisan vendor:publish --provider="Sudip\RoleCreator\Providers\AppServiceProvider" --tag=role-migrations
```


#### Publish seeder file

You will need to publish seeder file to add data in `permissions` table.

```
php artisan vendor:publish --provider="Sudip\RoleCreator\Providers\AppServiceProvider" --tag=role-seeds
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/sudippalash/role-creator?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/sudippalash/role-creator?style=flat-square
[ico-license]: https://img.shields.io/github/license/sudippalash/role-creator?style=flat-square
[link-packagist]: https://packagist.org/packages/sudippalash/role-creator
[link-downloads]: https://packagist.org/packages/sudippalash/role-creator
[link-author]: https://github.com/sudippalash
