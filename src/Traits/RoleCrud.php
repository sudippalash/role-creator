<?php

namespace Sudip\RoleCreator\Traits;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait RoleCrud
{
    use RoleUtility;

    public function index(Request $request)
    {
        $sql = Role::where('guard_name', $this->guardName)->orderBy($request->sortby ?? 'id', $request->sort ?? 'ASC');

        $sql->whereNotIn('name', $this->hideRoleArray());

        if ($request->q && $request->q_fields) {
            $sql->where(function ($q) use ($request) {
                $qFields = explode(',', $request->q_fields);
                foreach ($qFields as $ck => $field) {
                    if ($ck == 0) {
                        $q->where($field, 'LIKE', $request->q.'%');
                    } else {
                        $q->orWhere($field, 'LIKE', $request->q.'%');
                    }
                }
            });
        }

        if ($request->status) {
            $sql->where('status', $request->status);
        }

        $records = $sql->paginate($request->limit ?? 15);

        $cssClass = $this->cssGenerate();
        $routeName = $this->routeName;

        return view($this->getBladeName().'.index', compact('records', 'routeName', 'cssClass'));
    }

    public function create()
    {
        $permissioDone = [];
        $permissionArr = [];
        $permissions = Permission::where('guard_name', $this->guardName)->get();
        foreach ($permissions as $per) {
            $permissionArr[$per->module][] = (object) [
                'id' => $per->id,
                'name' => $per->name,
                'label' => $this->prettyPrint($per->name, $per->module),
                'module' => $this->prettyPrint($per->module),
            ];
        }

        $cssClass = $this->cssGenerate();
        $routeName = $this->routeName;

        return view($this->getBladeName().'.create', compact('permissioDone', 'permissionArr', 'routeName', 'cssClass'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:'.config('permission.table_names.roles'),
            'permissions' => 'required|array|min:1',
        ]);

        $storeData = [
            'name' => $request->name,
            'guard_name' => $this->guardName,
        ];
        $data = Role::create($storeData);

        $data->syncPermissions($request->permissions);

        return redirect()->route($this->routeName.'.index')->with(config('role-creator.flash_success'), trans('role-creator::sp_role_creator.create_message'));
    }

    public function show(Request $request, $id)
    {
        $data = Role::with('permissions')->where('guard_name', $this->guardName)->whereNotIn('name', $this->hideRoleArray())->where('id', $id)->firstOrFail();

        $permissioDone = [];
        foreach ($data->permissions as $per) {
            $permissioDone[$this->prettyPrint($per->module)][] = $this->prettyPrint($per->name, $per->module);
        }

        $cssClass = $this->cssGenerate();
        $routeName = $this->routeName;

        return view($this->getBladeName().'.show', compact('data', 'permissioDone', 'routeName', 'cssClass'));
    }

    public function edit(Request $request, $id)
    {
        $data = Role::with('permissions')->where('guard_name', $this->guardName)->whereNotIn('name', $this->hideRoleArray())->where('id', $id)->firstOrFail();

        $permissioDone = [];
        foreach ($data->permissions as $per) {
            $permissioDone[$per->module][] = $per->name;
        }

        $permissions = Permission::where('guard_name', $this->guardName)->get();
        $permissionArr = [];
        foreach ($permissions as $per) {
            $permissionArr[$per->module][] = (object) [
                'id' => $per->id,
                'name' => $per->name,
                'label' => $this->prettyPrint($per->name, $per->module),
                'module' => $this->prettyPrint($per->module),
            ];
        }

        $cssClass = $this->cssGenerate();
        $routeName = $this->routeName;

        return view($this->getBladeName().'.edit', compact('data', 'permissioDone', 'permissionArr', 'routeName', 'cssClass'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:'.config('permission.table_names.roles').',name,'.$id.',id',
            'permissions' => 'required|array|min:1',
        ]);

        $data = Role::where('guard_name', $this->guardName)->whereNotIn('name', $this->hideRoleArray())->where('id', $id)->firstOrFail();

        $storeData = [
            'name' => $request->name,
            'guard_name' => $this->guardName,
        ];

        $data->update($storeData);

        $data->syncPermissions($request->permissions);

        return redirect()->route($this->routeName.'.index')->with(config('role-creator.flash_success'), trans('role-creator::sp_role_creator.update_message'));
    }

    public function destroy(Request $request, $id)
    {
        $data = Role::where('guard_name', $this->guardName)->whereNotIn('name', $this->hideRoleArray())->where('id', $id)->firstOrFail();
        $data->delete();

        return redirect()->route($this->routeName.'.index')->with(config('role-creator.flash_success'), trans('role-creator::sp_role_creator.delete_message'));
    }

    private function hideRoleArray()
    {
        if (empty($this->hideRoles)) {
            return [];
        }

        if (is_array($this->hideRoles)) {
            return $this->hideRoles;
        } else {
            return [$this->hideRoles];
        }
    }

    private function getBladeName()
    {
        if (config('role-creator.bootstrap_v') == 3) {
            $blade = 'role-creator::bootstrap3';
        } elseif (config('role-creator.bootstrap_v') == 4) {
            $blade = 'role-creator::bootstrap4';
        } else {
            $blade = 'role-creator::bootstrap5';
        }

        return $blade;
    }
}
