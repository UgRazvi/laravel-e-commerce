<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function userDashboard()
    {
        return view("front.account.dashboard");
    }
    public function deleteAccount()
    {
        return view("front.account.deleteAccount");
    }
    public function mynCash()
    {
        return view("front.account.mynCash");
    }
    public function mynCredit()
    {
        return view("front.account.mynCredit");
    }
    public function mynInsider()
    {
        return view("front.account.myn-insider");
    }

    public function termsCondition()
    {
        return view("front.account.termsCondition");
    }
    public function privacyPolicy()
    {
        return view("front.account.privacyPolicy");
    }
}
