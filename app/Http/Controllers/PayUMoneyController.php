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

        //$PAYU_BASE_URL = "https://secure.payu.in"; // PRODUCATION
        $name = $request->name;
        $successURL = route('pay.u.response');
        $failURL = route('pay.u.cancel');
        $email = $request->email;
        $phone = $request->mobile_no;
        $amount = $request->amount;

        $action = '';
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $posted = array();
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

        if (empty($posted['txnid'])) {
            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        } else {
            $txnid = $posted['txnid'];
        }

        $hash = '';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

        if (empty($posted['hash']) && sizeof($posted) > 0) {
            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';
            foreach ($hashVarsSeq as $hash_var) {
                $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                $hash_string .= '|';
            }
            $hash_string .= $SALT;

            $hash = strtolower(hash('sha512', $hash_string));
            $action = $PAYU_BASE_URL . '/_payment';
        } elseif (!empty($posted['hash'])) {
            $hash = $posted['hash'];
            $action = $PAYU_BASE_URL . '/_payment';
        }

        return view('front.pay-u', compact('action', 'hash', 'MERCHANT_KEY', 'txnid', 'successURL', 'failURL', 'name', 'email', 'phone', 'amount'));
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