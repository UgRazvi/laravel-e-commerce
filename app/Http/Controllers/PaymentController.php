<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // dd($request->all());
        $merchantKey = env('PAYU_MERCHANT_KEY');
        $merchantSalt = env('PAYU_MERCHANT_SALT');

        // Generate a unique transaction ID
        $transactionId = uniqid();

        // Prepare the payment data
        $data = [
            'key' => $merchantKey,
            'txnid' => $transactionId,
            'amount' => (int) ($request->amount),
            'productinfo' => $request->productinfo,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'surl' => route('front.payment.success'),
            'furl' => route('front.payment.fail'),
            'hash' => $this->generateHash($merchantKey, $merchantSalt, $transactionId, $request->amount, $request->productinfo, $request->firstname, $request->email, $request->phone),
        ];
        // dd($data);
        return view('payments.payu', compact('data'));
    }

    private function generateHash($key, $salt, $txnid, $amount, $productinfo, $firstname, $email)
    {
        // Construct the hash string with the required parameters
        $hashString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $salt;

        // Generate the hash using SHA-512
        return strtolower(hash('sha512', $hashString));
    }



    public function success(Request $request)
    {

        $txnId = $request->input('mihpayid'); // Adjust this based on how you get the orderId
        // dd($txnId);
        return redirect()->route('front.thank', $txnId);
    }

    public function fail(Request $request)
    {
        // Handle failed payment
        session()->flash("error", "Your payment failed. Please try again.");
        return redirect()->route('front.checkout');
    }
}
