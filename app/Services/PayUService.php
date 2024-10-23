<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session; // Ensure Session is imported

class PayUService
{
    public function processPaymentPayU($request)
    {
        $user = Auth::user();

        // Here, create your order and payment data
        $subTotal = Cart::subtotal(2, '.', '');
        $shipping = 0;
        $grandTotal = $subTotal;

        // Calculate any discounts as you are already doing
        $couponCode = null;
        $couponCodeId = null;
        $discount = 0;

        // Calculate discount if applicable
        if (Session()->has('code')) {
            $couponCode = Session()->get('code')->code;
            $couponCodeId = Session()->get('code')->id;
            $code = Session()->get('code');
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
            $grandTotal = $subTotal - $discount; // After Discount calculation logic
        }

        // Get customer address
        $customerAddress = CustomerAddress::where('user_id', $user->id)->where('default_address', 1)->first();

        // Create new order
        $order = new Order;
        $order->user_id = $user->id;
        $order->subtotal = $subTotal;
        $order->shipping = $shipping;
        $order->coupon_code = $couponCode;
        $order->coupon_code_id = $couponCodeId;
        $order->discount = $discount;
        $order->grand_total = ($subTotal - $discount) + $shipping;
        $order->name = $customerAddress->name;
        $order->mobile_no = $customerAddress->mobile_no;
        $order->address = $customerAddress->address;
        $order->locality_town = $customerAddress->locality_town;
        $order->city = $customerAddress->city;
        $order->state = $customerAddress->state;
        $order->pincode = $customerAddress->pincode;
        $order->save();

        // Store order items in the order items table
        foreach (Cart::content() as $item) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->name = $item->name;
            $orderItem->qty = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->total = (($item->price) * ($item->qty));
            $orderItem->save();
        }

        // Prepare PayU payment data
        $payuData = [
            'key' => env('PAYU_MERCHANT_KEY'), // Your PayU Merchant Key
            'txnid' => 'Order#'.$order->id, // Unique transaction ID
            'amount' => (int) ($grandTotal),
            'productinfo' => 'Order #' . $order->id,
            'firstname' => $user->name,
            'email' => $user->email,
            'phone' => $user->mobile_no,
            'surl' => route('front.payment.success'), // Success URL
            'furl' => route('front.payment.fail'), // Failure URL
            // Add other necessary fields based on PayU requirements
        ];

        // Generate hash using PayU hash algorithm
        $payuData['hash'] = $this->generatePayUHash($payuData);
        dd("payuData : ", $payuData);

        // Return response with redirect URL and PayU data
        return response()->json([
            'status' => true,
            'payuData' => $payuData, // Send PayU data to frontend to use in form
            'redirectUrl' => 'https://test.payu.in/_payment', // PayU URL
        ]);
    }
    private function generatePayUHash($payuData)
    {
        $key = env('PAYU_MERCHANT_KEY'); // PayU merchant key
        $salt = env('PAYU_MERCHANT_SALT'); // PayU merchant salt

        // dd($payuData);

        // dd($key, $salt, $payuData);
        // Concatenate fields in the required order
        $hashString = $key . '|' .
            $payuData['txnid'] . '|' .
            $payuData['amount'] . '|' .
            $payuData['productinfo'] . '|' .
            $payuData['firstname'] . '|' .
            $payuData['email'] . '||||||||||' . $salt;

        // Generate the hash using SHA-512
        return strtolower(hash('sha512', $hashString));
    }
}