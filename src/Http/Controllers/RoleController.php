<?php

namespace Sudip\RoleCreator\Http\Controllers;

use App\Http\Controllers\Controller;
use Sudip\RoleCreator\Traits\RoleCrud;

class RoleController extends Controller
{
    use RoleCrud;
    
    protected $guardName, $routeName, $hideRoles;

    public function __construct()
    {
        $this->guardName = config('role-creator.auth_guard_name');
        $this->routeName = config('role-creator.route_name');
        $this->hideRoles = config('role-creator.hide_role_names');
    }
}