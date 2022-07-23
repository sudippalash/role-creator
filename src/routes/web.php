<?php

Route::group(['namespace' => 'Sudip\RoleCreator\Http\Controllers'], function () {

    $middlewareArr = is_array(config('role-creator.middleware')) ? config('role-creator.middleware') : [];
    $middlewares = array_merge(['web'], $middlewareArr);

    Route::group(['middleware' => $middlewares], function () {
        Route::get(config('role-creator.route_prefix'), 'RoleController@index')->name(config('role-creator.route_name').'.index');
        Route::get(config('role-creator.route_prefix') . '/create', 'RoleController@create')->name(config('role-creator.route_name').'.create');
        Route::post(config('role-creator.route_prefix'). '/store', 'RoleController@store')->name(config('role-creator.route_name') . '.store');
        Route::get(config('role-creator.route_prefix') . '/{id}', 'RoleController@show')->name(config('role-creator.route_name').'.show');
        Route::get(config('role-creator.route_prefix') . '/{id}/edit', 'RoleController@edit')->name(config('role-creator.route_name').'.edit');
        Route::put(config('role-creator.route_prefix'). '/{id}/update', 'RoleController@update')->name(config('role-creator.route_name') . '.update');
        Route::delete(config('role-creator.route_prefix'). '/{id}/destroy', 'RoleController@update')->name(config('role-creator.route_name') . '.destroy');
    });
});
