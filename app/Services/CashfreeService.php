<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CashfreeService
{
    private $appId;
    private $secretKey;
    private $baseUrl;

    public function __construct()
    {
        $this->appId = config('myntra_credentials.cashfree.app_id');
        $this->secretKey = config('myntra_credentials.cashfree.secret_key');
        $this->baseUrl = config('myntra_credentials.cashfree.env') === 'production'
            ? 'https://api.cashfree.com'
            : 'https://sandbox.cashfree.com';
    }

    /**
     * Initiate Payment Order with Cashfree.
     *
     * @param array $orderData
     * @return array
     */

     public function cashFreePay(Request $request)
     {
         // Prepare order data from the request
         $orderData = [
             'order_id' => uniqid('order_'), // generate a unique order ID
             'order_amount' => $request->amount,
             'order_currency' => 'INR',
             'order_note' => 'Payment for Order #'.uniqid(),
             'customer_name' => $request->name,
             'customer_email' => $request->email,
             'customer_phone' => $request->phone,
             'return_url' => route('front.cashfreeCallback'), // URL to handle CashFree's response
             'notify_url' => route('front.cashfreeNotification'), // Optional URL for notifications
         ];
     
         // Create the order with CashFree API
         $response = $this->createOrder($orderData);
     
         if (isset($response['error']) && $response['error']) {
             return response()->json(['error' => 'Payment initiation failed', 'message' => $response['message']], 500);
         }
     
         // Redirect to CashFree payment page (based on CashFree's response)
         $paymentUrl = $response['payment_link']; // Assuming the CashFree API returns this
     
         return redirect($paymentUrl);
     }
      
    public function createOrder(array $orderData)
    {
        $url = $this->baseUrl . '/pg/orders';

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'x-client-id' => $this->appId,
            'x-client-secret' => $this->secretKey,
        ];

        $response = Http::withHeaders($headers)->post($url, $orderData);

        if ($response->successful()) {
            return $response->json();
        }

        return [
            'error' => true,
            'message' => $response->body(),
        ];
    }

    /**
     * Verify Payment by Order ID.
     *
     * @param string $orderId
     * @return array
     */
    public function verifyPayment($orderId)
    {
        $url = $this->baseUrl . "/pg/orders/{$orderId}";

        $headers = [
            'Accept' => 'application/json',
            'x-client-id' => $this->appId,
            'x-client-secret' => $this->secretKey,
        ];

        $response = Http::withHeaders($headers)->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return [
            'error' => true,
            'message' => $response->body(),
        ];
    }
}
