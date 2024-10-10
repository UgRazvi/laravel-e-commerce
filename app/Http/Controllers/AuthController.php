<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

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
}
