<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = ['pageHeader' => false];

        $roles = Role::all();
        $rolesWithCount = Role::withCount('accounts')->get();
        $permissions = Permission::all();
        $rolePermissions = []; // Array to store the role permissions

        foreach ($roles as $role) {
            $permissionIds = $role->permissions()->pluck('permissions.id')->toArray();
            $rolePermissions[$role->id] = $permissionIds;
        }

        return view('content.apps.rolesPermission.app-access-roles', ['pageConfigs' => $pageConfigs])
            ->with(compact(
                'roles',
                'rolesWithCount',
                'permissions',
                'rolePermissions',
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolePermissionRequest $request)
    {
        // Create a new role instance
        $role = Role::create([
            'name' => $request->input('modalRoleName'),
        ]);

        // Get the selected permissions from the request
        $permissions = $request->except('_token', 'modalRoleName');

        // Attach the selected permissions to the role
        foreach ($permissions as $slug => $value) {
            if ($value == 1) {
                $permission = Permission::where('slug', $slug)->first();
                if ($permission) {
                    $role->permissions()->attach($permission);
                }
            }
        }
        Session::flash('success', 'Create successfully role ' . $request->input('modalRoleName'));
        // Return a response indicating the success of the operation
        return response()->json(['success' => true, 'message' => 'Role created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->except('_token', 'modalRoleName');

        // Attach the selected permissions to the role
        foreach ($permissions as $slug => $value) {
            $permission = Permission::where('slug', $slug)->first();
            if ($permission) {
                if ($value == 1) {
                    $role->permissions()->attach($permission);
                } elseif ($value == 0) {
                    $role->permissions()->detach($permission);
                }
            }
        }
        Session::flash('success', 'You have changed permission for role '. $role->name);
        return redirect()->route('admin-access-roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Delete the role and its permissions
        $role->permissions()->detach();
        $role->delete();
        
        Session::flash('success', 'You have deleted role '. $role->name);
        return response()->json(['message' => 'Role and permissions deleted successfully']);

    }
}
