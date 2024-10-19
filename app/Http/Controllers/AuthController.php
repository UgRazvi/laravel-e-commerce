<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccDelInfo;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

            session()->flash("success", "Hey <strong> {$request->name} </strong>, You've been registered successfully.");
            //ALert laravel
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),  // Use 'errors' instead of 'error'
            ]);
        }
    }

    public function login()
    {
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

    public function profileUpdate(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'mobile_no' => 'required|string|max:10',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:male,female',
            'birthday' => 'nullable|date_format:d/m/Y',
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

        // Convert the birthday from dd/mm/yyyy to Y-m-d format if provided
        if ($request->input('birthday')) {
            $birthday = \DateTime::createFromFormat('d/m/Y', $request->input('birthday'));
            if ($birthday) {
                $user->birthday = $birthday->format('Y-m-d');
            }
        }

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

}
