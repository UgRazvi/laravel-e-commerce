<?php

namespace App\Http\Controllers;

use App\Models\TempImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    // public function store(Request $request)
    // {
    //     // Validation rules
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'mobile_no' => 'required|numeric|min:10',
    //         'birthday' => 'required|date',
    //         'gender' => 'required|in:Male,Female',
    //         'role' => 'required|in:1,2',  // assuming 1=User, 2=Admin
    //         'status' => 'required|in:0,1',
    //         'password' => 'required|string|min:8|confirmed', // Password confirmation
    //     ]);

    //     // Create a new user and hash the password
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'mobile_no' => $request->mobile_no,
    //         'birthday' => $request->birthday,
    //         'gender' => $request->gender,
    //         'role' => $request->role,
    //         'status' => $request->status,
    //         'password' => Hash::make($request->password), // Hashing the password before saving
    //     ]);

    //     // Redirect to the user listing page or another page with a success message
    //     return redirect()->route('users.index')->with('success', 'User created successfully!');
    // }
    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email', // Disabled Temporarily For Testing & Debugging Purposes.
            'mobile_no' => 'required|numeric|min:10',
            'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'role' => 'required|in:1,2',  // assuming 1=User, 2=Admin
            'password' => 'required|string|min:8|confirmed', // Password confirmation
            'status' => 'required|in:0,1',
        ]);
        // dd("VALIDATOR" , $validator);

        if ($validator->passes()) {

            // dd("PASSED");
            $user = new User(); // Making a new Instance of Category Model.
            $user->name = $request->name; // Getting Name (Values) From The Form Using Request Method
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->save();
            // Save Temporary Image Permanently In Dtabase Here.
            if (!empty($request->image_id)) {

                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);
                $newImageName = $user->id . '.' . $ext;
                $sPath = public_path("/tempImgs/$tempImage->name");
                $dPath = public_path("/uploads/Users/$newImageName");
                // File::copy($sPath, $dPath);
                File::move($sPath, $dPath);
                $user->image = $newImageName;
                $user->save();
            }
            session()->flash('success', 'User Has Been Added Successfully');

            // return response()->json([
            //     'status' => true,
            //     'message' => 'Category Has Been Added Successfully'
            // ]);

            return redirect()->route('users.index')->with('success', 'User has been added successfully.');

        } else {
            // return response()->json([
            //     'status' => false,
            //     'message' => 'Sorry Category Could Not Be Added. It Might Be Already Present. Please Check Once Againg'
            // ]);

            return redirect()->route('users.index')->with('error', 'Sorry, the user could not be added. It might be already present. Please check again.');

        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        $user = User::findOrFail($id);
        
        return view('admin.users.show', compact('user'));
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
    // public function update(Request $request, $id)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $id, // Ensure unique email except for the current user
    //         'mobile_no' => 'required|numeric|min:10',
    //         'birthday' => 'required|date',
    //         'gender' => 'required|in:Male,Female',
    //         'role' => 'required|in:1,2',  // 1=User, 2=Admin
    //         'status' => 'required|in:0,1',
    //         'password' => 'nullable|string|min:8|confirmed', // Password is optional but must match confirmation
    //     ]);

    //     // Find the user by ID
    //     $user = User::findOrFail($id);

    //     // Update the user data
    //     $user->update([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'mobile_no' => $request->mobile_no,
    //         'birthday' => $request->birthday,
    //         'gender' => $request->gender,
    //         'role' => $request->role,
    //         'status' => $request->status,
    //         'password' => $request->password ? bcrypt($request->password) : $user->password, // Update only if password is provided
    //     ]);

    //     // Redirect to the user listing page with a success message
    //     return redirect()->route('users.index')->with('success', 'User updated successfully!');
    // }
    public function update($userId, Request $request)
    {
        $user = user::find($userId);
        if (empty($user)) {
            session()->flash('error', 'Record Not Found !!!');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category Not Found'
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email', // Disabled Temporarily For Testing & Debugging Purposes.
            'mobile_no' => 'required|numeric|min:10',
            'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'role' => 'required|in:1,2',  // assuming 1=User, 2=Admin
            'password' => 'required|string|min:8|confirmed', // Password confirmation
            'status' => 'required|in:0,1',
        ]);
        if ($validator->passes()) {
            $user->name = $request->name; // Getting Name (Values) From The Form Using Request Method
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->save();

            $oldImage = $user->image;

            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $user->id .'.'. $ext;

                $sPath = public_path("/tempImgs/$tempImage->name");
                $dPath = public_path("/uploads/Users/$newImageName");

                // File::copy($sPath, $dPath);
                File::move($sPath, $dPath);

                $user->image = $newImageName;
                $user->save();

                // Deleting Old Image, To Reduce Server Load.
                // File::delete(public_path("/tempImg/$tempImage->name"));
                File::delete(public_path("/uploads/Users/$oldImage"));
            }

            // return redirect()->route('categories.index');

            return redirect()->route('users.index')->with('success', 'User has been added successfully.');
        } else {
            return redirect()->route('users.index')->with('error', 'Sorry, the user could not be added. It might be already present. Please check again.');

        }
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
