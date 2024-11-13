<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

class CashfreePaymentController extends Controller
{
    public function create(Request $request)
    {
        // dd("HELLO");
        return view('front.payment-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'mobile' => 'required',
            'amount' => 'required'
        ]);
    
        $url = "https://sandbox.cashfree.com/pg/orders";
    
        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",  // Ensure this is the correct version
            "x-client-id: " . env('CASHFREE_APP_ID'),
            "x-client-secret: " . env('CASHFREE_SECRET_KEY')
        ];
        
    
        $data = json_encode([
            'order_id' => 'order_' . rand(1111111111, 9999999999),
            'order_amount' => $validated['amount'],
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => 'customer_' . rand(111111111, 999999999),
                "customer_name" => $validated['name'],
                "customer_email" => $validated['email'],
                "customer_phone" => $validated['mobile'],
            ],
            "order_meta" => [
                "return_url" => 'http://127.0.0.1:8000/cashfree/payments/success/?order_id={order_id}&order_token={order_token}'
            ]
        ]);
    
        $curl = curl_init($url);
    
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    
        $resp = curl_exec($curl);
        curl_close($curl);
    
        // Log the response to inspect it
        \Log::info("Cashfree API Response: " . $resp);
    
        // Decode the response and check if payment_link exists
        $response = json_decode($resp);
    
        // Check if the response contains 'payment_link'
        if (isset($response->payment_link)) {
            return redirect()->to($response->payment_link);
        } else {
            // Log an error if the payment_link is not present
            \Log::error("Payment link not found in Cashfree API response.");
            return redirect()->route('callback')->with('error', 'Payment link not found');
        }
    }
    

    public function success(Request $request)
    {
        dd($request->all()); // PAYMENT STATUS RESPONSE
    }
    public function cashfreeView()
    {
        return view("front.payment-create");
    }
}
