<?php

namespace Sudip\RoleCreator\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/app.php', 'app',
            __DIR__ . '/../../config/role-creator.php', 'role-creator'
        );
    }


    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'rolemake');
        $this->publishes([
            __DIR__ . '/../../config/role-creator.php' => config_path('role-creator.php'),
        ], 'role-creator');

        $this->publishes([
            __DIR__.'/../database/migrations/add_module_column_to_permissions_table.php.stub' => $this->getMigrationFileName('add_module_column_to_permissions_table.php'),
        ], 'role-migrations');

        $this->publishes([
            __DIR__ . '/../database/seeders/PermissionSeeder.php' => database_path('seeders/PermissionSeeder.php'),
        ], 'role-seeds');
    }

    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path.'*_'.$migrationFileName);
            })
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
