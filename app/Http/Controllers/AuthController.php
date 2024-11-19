<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use App\Models\AccDelInfo;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Colors\Rgb\Channels\Red;

class AuthController extends Controller
{

    public function register()
    {
        return view("front.account.register");
    }

    public function processRegister(Request $request)
    {
        // $request->validate([]); // Better Alternative

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',  // Added validation for name
            'mobile_no' => 'required|min:10|numeric|unique:users',
            'password' => 'required|min:5|confirmed',  // Fixed 'confirmed'
            'email' => 'required|email|unique:users',  // Fixed the email validation rule
        ]);

        if ($validator->passes()) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;  // Fixed typo: 'emai' to 'email'
            $user->mobile_no = $request->mobile_no;
            $user->password = Hash::make($request->password);
            $user->save();

            // session()->flash("success", "Hey <strong> {$request->name} </strong>, You've been registered successfully.");
            //ALert laravel
            // return response()->json([
            //     'status' => true,
            // ]);

            return redirect()->route('account.login')->with("success", "<strong> {$request->name} </strong>, You've been registered successfully");
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),  // Use 'errors' instead of 'error'
            ]);
        }
    }

    public function login()
    {
        //  dd("LOGGED IN");
        return view("front.account.login");
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required|min:10|numeric',
            'password' => 'required',  // Fixed 'confirmed'
        ]);

        if ($validator->passes()) {

            if (Auth::attempt(['mobile_no' => $request->mobile_no, 'password' => $request->password], $request->get('remember'))) {

                if (session()->has("url.intended")) {
                    return redirect(session()->get("url.intended"));
                }

                $userName = Auth::user()->name; // Retrieve the user's name

                return redirect()->route('account.profile')
                    ->with("success", "Hey <strong>$userName</strong>, you've been logged in successfully !!!");
            } else {

                return redirect()->route('account.login')
                    ->withInput($request->only('mobile_no'))
                    ->with("error", "Either Mobile Number or Password is incorrect.");
            }
        } else {

            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('mobile_no'));
        }
    }

    public function profile()
    {
        return view("front.account.profile");
    }

    public function logout()
    {
        // Remove the coupon code from the session if it exists
        session()->forget('code');

        // dd("Unable to Log Out");
        Auth::logout();
        return redirect()->route('account.login')
            ->with("success", "You've been logout successfully.");
    }

    public function myOrders(Request $request)
    {
        $user = Auth::user();
        $myOrders = Order::where('user_id', $user->id)
            ->with(['orderItems.product', 'orderItems.product.product_images']);

        // Apply status filter
        if ($request->has('order_status') && $request->order_status != 'all') {
            $myOrders->where('order_status', $request->order_status);
            // dd($myOrders);
        }

        // Apply time filter
        if ($request->has('time') && $request->time != 'anytime') {
            switch ($request->time) {
                case '30_days':
                    $myOrders->where('created_at', '>=', now()->subDays(30)->toDateTimeString());
                    break;
                case '6_months':
                    $myOrders->where('created_at', '>=', now()->subMonths(6)->toDateTimeString());
                    break;
                case '1_year':
                    $myOrders->where('created_at', '>=', now()->subYear()->toDateTimeString());
                    break;
            }
        }

        // Apply search filter
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $myOrders->where(function ($query) use ($searchTerm) {
                $query->where('id', 'LIKE', '%' . $searchTerm . '%') // Search by order ID
                    ->orWhereHas('orderItems.product', function ($q) use ($searchTerm) {
                        $q->where('name', 'LIKE', '%' . $searchTerm . '%'); // Search by product name
                    });
            });
        }

        // Get the filtered orders and order by creation date
        $myOrders = $myOrders->orderBy('created_at', 'DESC')->get();

        return view('front.account.myOrders', compact('myOrders'));
    }


    public function profileEdit(Request $request)
    {
        return view("front.account.profile-edit");
    }

    // public function profileUpdate(Request $request)
    // {
    //     // Validate the incoming request data
    //     $request->validate([
    //         'mobile_no' => 'required|string|max:10',
    //         'name' => 'required|string|max:50',
    //         'email' => 'required|email|max:255',
    //         'gender' => 'required|in:male,female',
    //         'birthday' => 'nullable|date_format:d/m/Y',
    //         'alternate_mobile_no' => 'nullable|string|max:10',
    //         'hint_name' => 'nullable|string|max:50',
    //     ]);

    //     // Get the authenticated user
    //     $user = Auth::user(); // This should return an instance of the User model


    //     // Update user attributes
    //     $user->mobile_no = $request->input('mobile_no');
    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->gender = $request->input('gender');

    //     // Convert the birthday from dd/mm/yyyy to Y-m-d format if provided
    //     if ($request->input('birthday')) {
    //         $birthday = \DateTime::createFromFormat('d/m/Y', $request->input('birthday'));
    //         if ($birthday) {
    //             $user->birthday = $birthday->format('Y-m-d');
    //         }
    //     }

    //     $user->alternate_mobile_no = $request->input('alternate_mobile_no');
    //     $user->hint_name = $request->input('hint_name');

    //     // Save the updated user details
    //     $user->save();

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Profile updated successfully.');
    // }

    public function profileUpdate(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'mobile_no' => 'required|string|max:10',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'birthday' => 'nullable|date_format:Y-m-d', // Updated format
            'alternate_mobile_no' => 'nullable|string|max:10',
            'hint_name' => 'nullable|string|max:50',
        ]);

        // Get the authenticated user
        $user = Auth::user(); // This should return an instance of the User model

        // Update user attributes
        $user->mobile_no = $request->input('mobile_no');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');

        // Convert the birthday from d/m/Y to Y-m-d format if provided
        if ($request->input('birthday')) {
            // The birthday will now be in YYYY-MM-DD format from the date input field
            $birthday = \Carbon\Carbon::createFromFormat('Y-m-d', $request->input('birthday'));
            if ($birthday) {
                $user->birthday = $birthday->format('Y-m-d');
            } else {
                return redirect()->back()->withErrors(['birthday' => 'The birthday format is invalid.'])->withInput();
            }
        }

        // Other fields
        $user->alternate_mobile_no = $request->input('alternate_mobile_no');
        $user->hint_name = $request->input('hint_name');

        // Save the updated user details
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function deleteAccountSuggestion(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Validate the incoming request data
        $request->validate([
            'prod_exp' => 'nullable|in:yes,no',
            'bad_return' => 'nullable|in:yes,no',
            'less_variety' => 'nullable|in:yes,no',
            'excessive_communication' => 'nullable|in:yes,no',
            'other' => 'nullable|in:yes,no',
            'suggestions' => 'nullable|string|max:200',
        ]);

        // Create a new entry in the acc_del_infos table
        $accDelInfo = new AccDelInfo(); // Assuming AccDelInfo is the model for acc_del_infos
        $accDelInfo->user_id = $user->id; // Link to the authenticated user
        $accDelInfo->prod_exp = $request->has('prod_exp') ? 'yes' : 'no'; // Check if the checkbox was checked
        $accDelInfo->bad_return = $request->has('bad_return') ? 'yes' : 'no'; // Check if the checkbox was checked
        $accDelInfo->less_variety = $request->has('less_variety') ? 'yes' : 'no'; // Check if the checkbox was checked
        $accDelInfo->excessive_communication = $request->has('excessive_communication') ? 'yes' : 'no'; // Check if the checkbox was checked
        $accDelInfo->other = $request->has('other') ? 'yes' : 'no'; // Check if the checkbox was checked
        $accDelInfo->suggestions = $request->input('suggestions'); // Use input for suggestions
        $accDelInfo->save();

        // dd("hdfjdfb");

        // session()->flash("success", "Your suggestions have been submitted successfully.");
        session()->flash("success", "Your suggestions have been submitted successfully.");
        return redirect()->back();
        // return redirect()->route('account.deleteAccount')->with("success", "Your suggestions have been submitted successfully.");
    }

    public function wishlist()
    {

        $user = Auth::User();
        if($user === null){
            return redirect()->route('account.login')->with("error", "Please Login First.");
        }
        $wishlists = Wishlist::where('user_id', $user->id)->with('product')->get();
        // dd($wishlist);
        return view("front.wishlist", compact('wishlists'));
    }

    public function removeProductFromWishlist(Request $request)
    {
        // dd("HELLO");
        $user = Auth::user();
        $wishlist = Wishlist::where("user_id", $user->id)->where('product_id', $request->id)->first();

        if ($wishlist == null) {
            return response()->json([
                "status" => true,
                "message" => "Product has been removed already."
            ], 200);
        } else {
            $wishlist->delete();
            return response()->json([
                "status" => true,
                "message" => "Product removed successfully."
            ], 200);
        }
    }

    public function forgotPassword()
    {
        return view('front.account.forgotPassword');
    }

    public function processForgotPassword(Request $request)
    {
        // Validate email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',  // Built-in validation rule to check if email exists in 'users' table
        ]);

        // If validation fails
        if ($validator->fails()) {
            return redirect()->route('front.forgotPassword')->withErrors($validator)->withInput();
        }

        $token = Str::random(60);

        $user = User::where('email', $request->email)->first();

        $formData = [
            'user' => $user,
            'email' => $request->email,
            'token' => $token,
            'mailSubject' => 'We Received Your Request To Reset Password',
        ];

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::to($request->email)->send(new ResetPasswordEmail($formData));

        // Return a success view or redirect
        return redirect()->route('front.forgotPassword')->with("success", "Hey <strong> $user->name </strong> We have emailed your password reset link to <strong> $user->email </strong> !");
    }

    public function resetPassword($token)
    {   
        // dd($token);
        $token = DB::table('password_reset_tokens')->where('token', $token)->first();
        if ($token == null) {
            return redirect()->route('front.forgotPassword')->with("error", "Invalid token");
            }
        return view('front.account.reset-password', compact('token'));
    }

    public function processResetPassword(Request $request){
        // dd($request->all());
        $token = DB::table('password_reset_tokens')->where('token', $request->token)->first();
        // dd($token, $token->email);
        if ($token == null) {
            return redirect()->route('front.forgotPassword')->with("error", "Invalid token");
            }
            else{
                // dd($request->all());
                // dd($request->token, $request->email, $request->new_password);

                $user = User::where('email', $token->email)->first();
                // dd($user);

                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'new_password' => 'required|min:5',
                    'confirm_password' => 'required|same:new_password',
                ]);
                // dd("Validator", $validator);
                
                if($validator->fails()){
                    
                // dd("Validator Failed", $validator->fails());
                    return redirect()->route('front.resetPassword', $request->token)->withErrors($validator)->withInput();
                }
                else{
                    // dd("Validator Passed", $validator->passes());
                    // dd($user, $request->new_password);
                    $userName = $user->name;
                    $user = User::where('id', $user->id)->update([
                        'password' => Hash::make($request->new_password),
                    ]);
                    // dd($userName, $request->new_password);
                    DB::table('password_reset_tokens')->where('email', $request->email)->delete();
                    
                    return redirect()->route('account.login')->with("success", "Hey <strong> $userName </strong>, Your Password Has Been Changed/Updated Successsfully to (<strong> $request->new_password </strong>).");

                }

            }
    }
}
