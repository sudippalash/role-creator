<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $arrPermissions = [
            'user' => [
                'list',
                'show',
                'add',
                'edit',
                'delete',
            ],
        ];

        if (! empty($arrPermissions)) {
            foreach ($arrPermissions as $key => $apArr) {
                foreach ($apArr as $ap) {
                    Permission::updateOrCreate(['module' => $key, 'name' => $ap.' '.$key, 'guard_name' => config('role-creator.auth_guard_name')]);
                }
            }
        }
    }
}
