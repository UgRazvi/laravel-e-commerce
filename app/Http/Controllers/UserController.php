<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         // Start with the base query for orders
         $users = User::orderBy('id', 'ASC');

         // If there is a search keyword, apply it to the query
         if ($keyword = $request->get("keyword")) {
             $users->where(function ($query) use ($keyword) {
                 // Existing search criteria for orders table
                 $query->where("users.name", "like", "%{$keyword}%")
                     ->orWhere("orders.email", "like", "%{$keyword}%")
                     ->orWhere("orders.mobile_no", "like", "%{$keyword}%")
                     ->orWhere("orders.gender", "like", "%{$keyword}%")
                     ->orWhere("orders.role", "like", "%{$keyword}%")
                     ->orWhere("orders.birthday", "like", "%{$keyword}%")
                ->orWhere("orders.status", "like", "%{$keyword}%");
             });
         }
 
 
         // Apply pagination on the query and fetch the results
         $users = $users->get();
        return view("admin.users.list", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_no' => 'required|numeric|min:10',
            'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'role' => 'required|in:1,2',  // assuming 1=User, 2=Admin
            'status' => 'required|in:0,1',
            'password' => 'required|string|min:8|confirmed', // Password confirmation
        ]);

        // Create a new user and hash the password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'role' => $request->role,
            'status' => $request->status,
            'password' => Hash::make($request->password), // Hashing the password before saving
        ]);

        // Redirect to the user listing page or another page with a success message
        return redirect()->route('users.index')->with('success', 'User created successfully!');
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
    // Edit the user in the database
    public function edit($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        
        // Return the edit view with the user data
        return view('admin.users.edit', compact('user'));
    }


    /**
     * Update the specified resource in storage.
     */
    // Update the user in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ensure unique email except for the current user
            'mobile_no' => 'required|numeric|min:10',
            'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'role' => 'required|in:1,2',  // 1=User, 2=Admin
            'status' => 'required|in:0,1',
            'password' => 'nullable|string|min:8|confirmed', // Password is optional but must match confirmation
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user data
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'role' => $request->role,
            'status' => $request->status,
            'password' => $request->password ? bcrypt($request->password) : $user->password, // Update only if password is provided
        ]);

        // Redirect to the user listing page with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Delete the user from the database
    public function destroy($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect to the user listing page with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
