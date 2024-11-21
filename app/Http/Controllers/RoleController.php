<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
   
    public function __constructor(){
        $this->middleware('permission:View Roles', ['only' => ['index']]);
        $this->middleware('permission:Create Roles', ['only' => ['create','store','addPermissions', 'updatePermissionsToRole']]);
        $this->middleware('permission:Edit Roles', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Roles', ['only' => ['destroy']]);
    }
    
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("Hello Role INDEX");
        $roles = Role::all();
        return view("roles-permission.role.list", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd("HELLo Role CREATE");
        return view("roles-permission.role.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd("HELLo Role STORE", $request->all());
        $request->validate([
            "name" => "required|string|unique:permissions,name",
        ]);
        $role = Role::create([
            "name" => $request->name,
        ]);
        return redirect()->route("roles.index")->with("success", "Permission <strong>$request->name</strong> created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {

        // dd("HELLo Role EDIT");
        return view("roles-permission.role.edit", compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming data
        $request->validate([
            "name" => "required|string|unique:roles,name," . $id, // Exclude the current permission from the unique check
        ]);

        // Find the existing Role by its ID
        $role = Role::findOrFail($id);

        // Update the Role with the new name
        $role->update([
            "name" => $request->name,
        ]);

        // Redirect back to the permissions list with a success message
        return redirect()->route("roles.index")
            ->with("success", "Role <strong>{$request->name}</strong> updated successfully");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // dd($id);
        $role = Role::find($id);
        // dd($role);
        $role->delete();
        return redirect()->route("roles.index")->with("success", "Role <strong>$role->name</strong> Has been deleted");
    }

    public function addPermissionsToRole(Request $request, $roleId)
    {

        // dd($roleId);
        $role = Role::findOrFail($roleId);
        // dd($role);
        $permissions = Permission::get();
        // dd($permissions);
        $rolePermissions = DB::table('role_has_permissions')->where("role_has_permissions.role_id", $roleId)->pluck("role_has_permissions.permission_id", "role_has_permissions.permission_id")->all();
        // dd($rolePermissions);
        return view("roles-permission.role.add-permissions", compact("role", "permissions", "rolePermissions"));
    }
    public function updatePermissionsToRole(Request $request, $roleId)
    {
        // dd($roleId, $request->all(), $request->permissions);
        // Validate that permissions are sent
        $request->validate([
            'permissions' => 'required|array',
            // 'permissions.*' => 'exists:permissions,name',
        ]);
        $role = Role::findOrFail($roleId);

        // Sync the permissions with the role
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Permissions updated to Roles successfully!');
    }
}
