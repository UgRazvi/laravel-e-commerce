<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("Hello Permission INDEX");
        $permissions = Permission::all();
        return view("roles-permission.permission.list", compact("permissions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd("HELLo Permission CREATE");
        return view("roles-permission.permission.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd("HELLo Permission STORE", $request->all());
        $request->validate([
            "name"=> "required|string|unique:permissions,name",
            // "guard_name" => "required|string|in:admin,user", 
        ]);
        $permission = Permission::create([ 
            "name"=>$request->name,
            // "guard_name" => $request->guard_name,
        ]);
        return redirect()->route("permissions.index")->with("success", "Permission <strong>$request->name</strong> created with <strong>$request->guard_name</strong> successfully");
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
    public function edit(Permission $permission)
    {

        // dd("HELLo Permission EDIT");
        return view("roles-permission.permission.edit", compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required|string|unique:permissions,name," . $id, // Exclude the current permission name from uniqueness check
            // "guard_name" => "required|string|in:admin,user", // Correct validation for guard_name
        ]);

        // Find the permission by its ID
        $permission = Permission::findOrFail($id);

        // Update the permission
        $permission->update([
            "name" => $request->name,
            // "guard_name" => $request->guard_name, // Make sure to update the guard_name as well
        ]);

        // Redirect back with success message
        return redirect()->route("permissions.index")
            ->with("success", "Permission <strong>{$request->name}</strong> updated <strong>$request->guard_name</strong> successfully");
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // dd($id);
        $permission = Permission::find($id);
        // dd($permission);
        $permission->delete();
        return redirect()->route("permissions.index")->with("success", "Permission <strong>$permission->name</strong> Has been deleted");
    }
}
