<?php

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
    | If role route use any middleware then provide it or leave empty array. Example: ['auth']
    */

    'route_name' => 'user.roles',
    'route_prefix' => 'user/roles',
    'middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | Role & Permission Name Pretty Print
    |--------------------------------------------------------------------------
    |
    | You can set the delimiter to separate your role/permission name for pretty preview
    | Example: array('-', '_', '=', '|', '/')
    |
    */

    'role_permission_name_separator' => ['-', '_'],

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
    | Role Prevent
    |--------------------------------------------------------------------------
    |
    | Those role names hide from list and prevent from edit & delete. Example ['Super Admin']
    |
    */

    'hide_role_names' => [],

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
