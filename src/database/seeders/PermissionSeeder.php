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
                'list user',
                'show user',
                'add user',
                'edit user',
                'delete user',
                'bulk action user'
            ],
        ];

        if (!empty($arrPermissions)) {
            foreach ($arrPermissions as $key => $apArr) {
                foreach ($apArr as $ap) {
                    Permission::updateOrCreate(
                        ['module' => $key, 'name' => $ap, 'guard_name' => 'admin'], 
                        ['module' => $key, 'name' => $ap, 'guard_name' => 'admin']
                    );
                }
            }
        }
    }
}
