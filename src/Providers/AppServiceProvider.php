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
            __DIR__ . '/../../config/role-creator.php', 'role-creator'
        );
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'role-creator');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'role-creator');

        //Spatie Permission config & migration published
        $ds = new \ReflectionClass(\Spatie\Permission\PermissionServiceProvider::class);
        $path = str_replace(DIRECTORY_SEPARATOR . $ds->getShortName() . '.php', '', $ds->getFileName());

        $this->publishes([
            //Spatie Permission config & migration published
            $path . '/../config/permission.php' => config_path('permission.php'),
            $path . '/../database/migrations/create_permission_tables.php.stub' => $this->getMigrationFileName('create_permission_tables.php', time()),


            __DIR__ . '/../database/seeders/PermissionSeeder.php' => database_path('seeders/PermissionSeeder.php'),
            __DIR__ . '/../../config/role-creator.php' => config_path('role-creator.php'),
            __DIR__.'/../database/migrations/add_module_column_to_permissions_table.php.stub' => $this->getMigrationFileName('add_module_column_to_permissions_table.php', (time() + 1)),
        ], 'required');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/role-creator'),
        ], 'lang');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/role-creator'),
        ], 'views');
    }

    protected function getMigrationFileName($migrationFileName, $time): string
    {
        $timestamp = date('Y_m_d_His', $time);

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path.'*_'.$migrationFileName);
            })
            ->push($this->app->databasePath()."/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }
}
