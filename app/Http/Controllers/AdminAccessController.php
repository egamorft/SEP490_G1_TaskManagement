<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRoleRequest;
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
    public function create(PermissionRoleRequest $request)
    {
        Permission::create([
            'name' => $request->input('modalPermissionName'),
            'slug' => $request->input('modalPermissionSlug'),
        ]);

        // Optionally, you can perform additional actions after creating the permission

        Session::flash('success', 'Create successfully permission to ' . $request->input('modalPermissionName'));
        // Redirect or return a response
        return response()->json(['success' => true, 'message' => 'Permission created successfully']);
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
    public function show(Request $request)
    {
        $id = $request->input('id');
        // Retrieve the record from the database
        $permission = Permission::find($id);

        if ($permission) {
            // Prepare the data to be sent back to the client
            $data = [
                'name' => $permission->name,
                'slug' => $permission->slug,
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Record not found',
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionRoleRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->input('modalPermissionName');
        $permission->slug = $request->input('modalPermissionSlug');
        $permission->save();

        Session::flash('success', 'Successfully edit permission for ' . $permission->name);
        return response()->json(['success' => true]);
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
        Session::flash('success', 'You have changed permission for role ' . $role->name);
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

        Session::flash('success', 'You have deleted role ' . $role->name);
        return response()->json(['message' => 'Role and permissions deleted successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $permission = Permission::findOrFail($id);

        // Delete the permission and its permissions
        $permission->roles()->detach();
        $permission->delete();

        Session::flash('success', 'You have deleted permission ' . $permission->name);
        return response()->json(['success' => true, 'message' => 'Permissions deleted successfully']);
    }
}
