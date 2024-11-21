<?php

namespace App\Http\Controllers;
// INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES ('7', 'App\\Models\\User;', '35');
use App\Models\TempImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function __constructor(){
        $this->middleware('permission:View Users', ['only' => ['index']]);
        $this->middleware('permission:Create Users', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Users', ['only' => ['edit','update']]);
        $this->middleware('permission:Delete Users', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */

    // List the user from the database to Dashboard
    public function index(Request $request)
    {
        // Start with the base query for users
        $users = User::with('roles')->orderBy('id', 'ASC');
    
        // If there is a search keyword, apply it to the query
        if ($keyword = $request->get("keyword")) {
            $users->where(function ($query) use ($keyword) {
                // Apply search criteria on the users table
                $query->where("users.name", "like", "%{$keyword}%")
                    ->orWhere("users.email", "like", "%{$keyword}%")
                    ->orWhere("users.mobile_no", "like", "%{$keyword}%")
                    ->orWhere("users.gender", "like", "%{$keyword}%")
                    ->orWhere("users.birthday", "like", "%{$keyword}%")
                    ->orWhere("users.status", "like", "%{$keyword}%");
            });
        }
    
        // Execute the query and fetch the results
        $users = $users->get();
    
        // Debugging: Use dd() to inspect the resulting collection, including roles
        // dd($users, $users->first()->roles);
    
        return view("admin.users.list", compact("users"));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch roles from the database
        $roles = Role::pluck('name')->toArray(); // Get only role names
        return view("admin.users.create", compact("roles"));
    }


    /**
     * Store a newly created resource in storage.
     */
    // Store the user in the database
    // public function store(Request $request)
    // {
    //     // dd($request->all());

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         // 'email' => 'required|email|unique:users,email', // Disabled Temporarily For Testing & Debugging Purposes.
    //         'mobile_no' => 'required|numeric|min:10',
    //         'birthday' => 'required|date',
    //         'gender' => 'required|in:Male,Female',
    //         'role' => 'required',  // assuming 1=User, 2=Admin
    //         'password' => 'required|string|min:8|confirmed', // Password confirmation
    //         'status' => 'required|in:0,1',
    //     ]);
    //     // dd("VALIDATOR" , $validator);

    //     if ($validator->passes()) {

    //         // dd("PASSED");
    //         $user = new User(); // Making a new Instance of Category Model.
    //         $user->name = $request->name; // Getting Name (Values) From The Form Using Request Method
    //         $user->email = $request->email;
    //         $user->mobile_no = $request->mobile_no;
    //         $user->birthday = $request->birthday;
    //         $user->gender = $request->gender;
    //         $user->role = $request->role;
    //         $user->status = $request->status;
    //         $user->password = Hash::make($request->password);
    //         $user->save();
    //         // Save Temporary Image Permanently In Dtabase Here.
    //         if (!empty($request->image_id)) {

    //             $tempImage = TempImage::find($request->image_id);
    //             $extArray = explode('.', $tempImage->name);
    //             $ext = last($extArray);
    //             $newImageName = $user->id . '.' . $ext;
    //             $sPath = public_path("/tempImgs/$tempImage->name");
    //             $dPath = public_path("/uploads/Users/$newImageName");
    //             // File::copy($sPath, $dPath);
    //             File::move($sPath, $dPath);
    //             $user->image = $newImageName;
    //             $user->save();
    //         }
    //         session()->flash('success', 'User Has Been Added Successfully');

    //         // return response()->json([
    //         //     'status' => true,
    //         //     'message' => 'Category Has Been Added Successfully'
    //         // ]);

    //         return redirect()->route('users.index')->with('success', 'User has been added successfully.');

    //     } else {
    //         // return response()->json([
    //         //     'status' => false,
    //         //     'message' => 'Sorry Category Could Not Be Added. It Might Be Already Present. Please Check Once Againg'
    //         // ]);

    //         return redirect()->route('users.index')->with('error', 'Sorry, the user could not be added. It might be already present. Please check again.');

    //     }
    // }
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->input('roles'));
        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile_no' => 'required|numeric|min:10',
            'birthday' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:0,1',
        ]);
        // if($validator){
        //     dd("VALIDATOR", $validator);
        // }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);
    
        // // Assign roles from request
        $user->assignRole($request->input('roles'));
    
        // Handle image processing
        if (!empty($request->image_id)) {
            $tempImage = TempImage::find($request->image_id);
            $ext = pathinfo($tempImage->name, PATHINFO_EXTENSION);
            $newImageName = $user->id . '.' . $ext;
            $sPath = public_path("/tempImgs/$tempImage->name");
            $dPath = public_path("/uploads/Users/$newImageName");
            File::move($sPath, $dPath);
            $user->image = $newImageName;
            $user->save();
        }
    
        session()->flash('success', 'User has been added successfully');
        return redirect()->route('users.index');
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
        $user = User::findOrFail($id); // Fetch the user to edit
        $roles = Role::pluck('name'); // Get all role names
        $userRoles = $user->roles->pluck('name')->toArray(); // Get roles assigned to the user
    
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }


    /**
     * Update the specified resource in storage.
     */
    // Update the user from the database
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
            'gender' => 'required|in:Male,Female', 'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
            'password' => 'required|string|min:8|confirmed', // Password confirmation
            'status' => 'required|in:0,1',
        ]);
        if ($validator->passes()) {
            $user->name = $request->name; // Getting Name (Values) From The Form Using Request Method
            $user->email = $request->email;
            $user->mobile_no = $request->mobile_no;
            $user->birthday = $request->birthday;
            $user->gender = $request->gender;
            $user->status = $request->status;
            $user->password = Hash::make($request->password);
            $user->save();

        $user->syncRoles($request->input('roles'));
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
