<?php

namespace Sudip\RoleCreator\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sudip\RoleCreator\Traits\RoleUtility;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    use RoleUtility;

    public function index(Request $request)
    {
        $sql = Role::orderBy($request->sortby ?? 'id', $request->sort ?? 'ASC');

        if ($request->q && $request->q_fields) {
            $sql->where(function($q) use($request) {
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
        $routeName = config('role-creator.route_name');
        $blade = config('role-creator.bootstrap_v') == 3 ? 'rolemake::bootstrap3' : 'rolemake::bootstrap';

        return view($blade . '.index', compact('records', 'routeName', 'cssClass'))->with('list', 1);
    }

    public function create()
    {
        $permissioDone = [];
        $permissionArr = [];
        $permissions = Permission::all();
        foreach($permissions as $per) {
            $permissionArr[$per->module][] = (object) [
                'id' => $per->id,
                'name' => $per->name,
            ];
        }
        
        $cssClass = $this->cssGenerate();
        $routeName = config('role-creator.route_name');
        $blade = config('role-creator.bootstrap_v') == 3 ? 'rolemake::bootstrap3' : 'rolemake::bootstrap';

        return view($blade . '.create', compact('permissioDone', 'permissionArr', 'routeName', 'cssClass'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:'.config('permission.table_names.roles'),
            'permissions' => 'required|array|min:1',
        ]);

        $storeData = [
            'name' => $request->name,
        ];
        $data = Role::create($storeData);

        $data->syncPermissions($request->permissions);

        return redirect()->route(config('role-creator.route_name') . '.index')->with('success', __('Role Created Successfully!'));
    }

    public function show(Request $request, $id)
    {
        $data = Role::with('permissions')->where('id', $id)->firstOrFail();
        
        $permissioDone = [];
        foreach ($data->permissions as $per) {
            $permissioDone[$per->module][] = $per->name;
        }
        
        $cssClass = $this->cssGenerate();
        $routeName = config('role-creator.route_name');
        $blade = config('role-creator.bootstrap_v') == 3 ? 'rolemake::bootstrap3' : 'rolemake::bootstrap';

        return view($blade . '.show', compact('data', 'permissioDone', 'routeName', 'cssClass'));
    }

    public function edit(Request $request, $id)
    {
        $data = Role::where('id', $id)->firstOrFail();
        
        $permissioDone = [];
        foreach ($data->permissions as $per) {
            $permissioDone[$per->module][] = $per->name;
        }

        $permissions = Permission::all();
        $permissionArr = [];
        foreach($permissions as $per) {
            $permissionArr[$per->module][] = (object) [
                'id' => $per->id,
                'name' => $per->name,
            ];
        }
        
        $cssClass = $this->cssGenerate();
        $routeName = config('role-creator.route_name');
        $blade = config('role-creator.bootstrap_v') == 3 ? 'rolemake::bootstrap3' : 'rolemake::bootstrap';

        return view($blade . '.edit', compact('data', 'permissioDone', 'permissionArr', 'routeName', 'cssClass'))->with('edit', $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:' . config('permission.table_names.roles') . ',name,'.$id.',id',
            'permissions' => 'required|array|min:1',
        ]);

        $data = Role::where('id', $id)->firstOrFail();

        $storeData = [
            'name' => $request->name,
        ];

        $data->update($storeData);

        $data->syncPermissions($request->permissions);

        return redirect()->route(config('role-creator.route_name') . '.index')->with('success', __('Role Updated Successfully!'));
    }

    public function destroy(Request $request, $id)
    {
        $data = Role::where('id', $id)->firstOrFail();
        $data->delete();
        
        return redirect()->route(config('role-creator.route_name') . '.index')->with('success', __('Role Deleted Successfully!'));
    }
}
