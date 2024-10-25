<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PayUMoneyController extends Controller
{
    public function payUMoneyView($request)
    {
        $user = Auth::user();

        $MERCHANT_KEY = env('PAYU_MERCHANT_KEY');
        $SALT = env('PAYU_MERCHANT_SALT');
        $PAYU_BASE_URL = "https://test.payu.in";

        $name = $request->name;
        $successURL = route('pay.u.response');
        $failURL = route('pay.u.cancel');
        $email = $request->email;
        $phone = $request->mobile_no;
        $amount = (string) $request->amount; // Ensure it's a string

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $posted = array(
            'key' => $MERCHANT_KEY,
            'txnid' => $txnid,
            'amount' => $amount,
            'firstname' => $name,
            'email' => $email,
            'phone' => $phone,
            'productinfo' => 'Webappfix',
            'surl' => $successURL,
            'furl' => $failURL,
            'service_provider' => 'payu_paisa',
        );

        // Generate hash
        $hash = $this->generateHash($MERCHANT_KEY, $SALT, $txnid, $amount, $productinfo, $name, $email);

        $action = $PAYU_BASE_URL . '/_payment';

        return view('front.pay-u', compact('action', 'hash', 'MERCHANT_KEY', 'txnid', 'successURL', 'failURL', 'name', 'email', 'phone', 'amount'));
    }

    private function generateHash($key, $salt, $txnid, $amount, $productinfo, $firstname, $email)
    {
        // Ensure the hash string format is exactly as required by PayU
        $hashString = "{$key}|{$txnid}|{$amount}|{$productinfo}|{$firstname}|{$email}||||||||||{$salt}";
        
        return strtolower(hash('sha512', $hashString));
    }

    public function payUResponse(Request $request)
    {
        dd('Payment Successfully Done');
    }

    public function payUCancel(Request $request)
    {
        dd('Payment Failed');
    }
}
