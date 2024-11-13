<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class CashfreePaymentController extends Controller
{
    public function create(Request $request)
    {
        // dd("HELLO");
        $user = Auth::user();
        $transactionId = uniqid();
        $subTotal = Cart::subtotal(2, '.', '');
        $discount = 0;
        $grandTotal = $subTotal;

        // Check if the cart is empty
        if (Cart::count() == 0) {
            return redirect()->route('front.cart')
                ->with("error", "You don't have any product in your cart yet.");
        }

        // Check if the user is logged in
        if (!Auth::check()) {
            if (!session()->has("url.intended")) {
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('account.login')
                ->with("error", "You're not logged in. Please log in first to access this page.");
        }

        // Remove intended URL session
        session()->forget("url.intended");

        // Fetch user's saved address
        $customerAddress = CustomerAddress::where('user_id', $user->id)->first();

        // Adding Ordering Logic Here: 
        $order = new Order;
        $order->user_id = $user->id;
        $order->subtotal = $subTotal;
        $order->shipping = 0;
        $order->coupon_code = $couponCode->code ?? null;
        $order->coupon_code_id = $couponCode->id ?? null;
        $order->discount = $discount;
        $order->grand_total = $grandTotal;
        $order->name = $customerAddress->name;
        $order->mobile_no = $customerAddress->mobile_no;
        $order->user_email = $user->email;
        $order->address = $customerAddress->address;
        $order->locality_town = $customerAddress->locality_town;
        $order->city = $customerAddress->city;
        $order->state = $customerAddress->state;
        $order->pincode = $customerAddress->pincode;
        $order->order_status = "pending";
        $order->transaction_id = $transactionId;
        $order->payment_status = "not_paid";
        // dd($order);
        $order->save();

        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->name = $item->name;
            $orderItem->qty = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->total = (($item->price) * ($item->qty));
            // dd($orderItem);
            $orderItem->save();
            
            $productData = Product::find($item->id);
            $currentQty = $productData->qty;
            $updatedQty = $currentQty - $item->qty;
            $productData->qty = $updatedQty;
            // dd($productData);
            $productData->save();
        }
        // Ordering Logic Ends Here.

        // Subtotal before discount
        $grandTotal = $subTotal = Cart::subtotal(2, '.', '');

        // Apply discount if available
        if (Session()->has('code')) {
            $code = Session()->get('code');
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
            $grandTotal = $subTotal - $discount;
        }

        // PayU configuration
        $MERCHANT_KEY = env('PAYU_MERCHANT_KEY');
        $SALT = env('PAYU_MERCHANT_SALT');
        $PAYU_BASE_URL = "https://test.payu.in";  // Use production URL for live

        $name = $user->name;
        $successURL = route('pay.u.response');
        $failURL = route('pay.u.cancel');
        $email = $user->email;
        $phone = $user->mobile_no;
        $amount = (int) $grandTotal;

        // Generate transaction ID
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

        // Concatenate all product names in the cart into a single string
        $productNames = [];
        foreach (Cart::content() as $item) {
            $productNames[] = $item->name;  // Product name from cart
        }
        $productinfo = implode(', ', $productNames);  // Join product names with a comma

        // Prepare posted data for PayU
        $posted = [
            'key' => $MERCHANT_KEY,
            'txnid' => $txnid,
            'amount' => $amount,
            'firstname' => $name,
            'email' => $email,
            'phone' => $phone,
            'productinfo' => $productinfo,  // Passing product info here
            'surl' => $successURL,
            'furl' => $failURL,
            'service_provider' => 'payu_paisa',
        ];

        // Generate hash for the request
        $hash = '';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email||||||||||";
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
        return view("front.payment-create", compact(
            "customerAddress",
            "discount",
            "grandTotal",
            "action",
            "hash",
            "MERCHANT_KEY",
            "txnid",
            "successURL",
            "failURL",
            "name",
            "email",
            "phone",
            "amount",
            "productinfo",
            "transactionId"
        ));
        // return view('front.payment-create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'mobile' => 'required',
            'amount' => 'required',
            'txnid' => 'required'
        ]);
    
        $url = "https://sandbox.cashfree.com/pg/orders";
    
        $headers = [
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",  // Ensure this is the correct version
            "x-client-id: " . env('CASHFREE_APP_ID'),
            "x-client-secret: " . env('CASHFREE_SECRET_KEY')
        ];
        
    
        $data = json_encode([
            // 'order_id' => 'order_' . rand(1111111111, 9999999999),
            'order_id' => $request->get('txnid'),
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
        log::info("Cashfree API Response: " . $resp);
    
        // Decode the response and check if payment_link exists
        $response = json_decode($resp);
    
        // Check if the response contains 'payment_link'
        if (isset($response->payment_link)) {
            return redirect()->to($response->payment_link);
        } else {
            // Log an error if the payment_link is not present
            Log::error("Payment link not found in Cashfree API response.");
            return redirect()->route('callback')->with('error', 'Payment link not found');
        }
    }

    // public function store()
    // {
    //     Http::post()
    // }
    

    public function success(Request $request)
    {
        // dd($request->all());
        Log::info('CashFree Payment Success Redirect Received', $request->all());

        $txnId = $request->input('order_id');
        $order = Order::where('transaction_id', $txnId);
        // dd($order);
        $order->update([
            'order_status' => 'delivered',
            'payment_status' => 'paid',
        ]);
        orderEmail($txnId, "customer");

        return redirect()->route('front.thank', $txnId);
    }
    public function cashfreeView()
    {
        return view("front.payment-create");
    }
}
