<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session; // Ensure Session is imported

class PayUService
{
    public function pay($request)
    {
        $user = Auth::user();
        $transactionId = uniqid();

        $merchantKey = env('PAYU_MERCHANT_KEY');
        $merchantSalt = env('PAYU_MERCHANT_SALT');

        $subTotal = Cart::subtotal(2, '.', '');
        $discount = 0;
        $grandTotal = $subTotal;

        if (Session()->has('code')) {
            $couponCode = Session()->get('code');
            if ($couponCode->type == 'percent') {
                $discount = ($couponCode->discount_amount / 100) * $subTotal;
            } else {
                $discount = $couponCode->discount_amount;
            }
            $grandTotal = $subTotal - $discount;
        }

        $customerAddress = CustomerAddress::where('user_id', $user->id)->where('default_address', 1)->first();

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
        //  dd($order);
        $order->save();

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

        // Ensure amount is string format for hash calculation
        $data = [
            'key' => $merchantKey,
            'txnid' => $transactionId,
            'amount' => (string) ($grandTotal), // Change to grandTotal
            'productinfo' => 'Your Product Info', // Provide actual product info
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $customerAddress->mobile_no,
            'surl' => route('front.payment.success'),
            'furl' => route('front.payment.fail'),
            'hash' => $this->generateHash(
                $merchantKey,
                $merchantSalt,
                $transactionId,
                (string) ($grandTotal),
                'Your Product Info', // Provide actual product info
                $request->firstname,
                $request->email
            ),
        ];

        return $data;
    }

    private function generateHash($key, $salt, $txnid, $amount, $productinfo, $firstname, $email)
    {
        // Including empty udf1 to udf5 in the hash as required by PayU
        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';

        // Hash string as per PayU documentation
        $hashString = "$key|$txnid|$amount|$productinfo|$firstname|$email|$udf1|$udf2|$udf3|$udf4|$udf5||||||$salt";

        // Generate the hash
        $hash = strtolower(hash('sha512', $hashString));

        // Log Hash Data for debugging
        Log::info("\n Hash Data: ", [
            'key' => $key,
            'txnid' => $txnid,
            'amount' => $amount,
            'productinfo' => $productinfo,
            'firstname' => $firstname,
            'email' => $email,
            'hash' => $hash,
        ]);

        return $hash;
    }


}


// class PayUService
// {
//     public function __construct()
//     {
//         // 
//     }
//     public function pay($request)
//     {
//         $user = Auth::User();
//         // Generate a unique transaction ID
//         $transactionId = uniqid();
//         // dd($request->all());
//         $merchantKey = env('PAYU_MERCHANT_KEY');
//         $merchantSalt = env('PAYU_MERCHANT_SALT');

//         // Prepare the payment data
//         $data = [
//             'key' => $merchantKey,
//             'txnid' => $transactionId,
//             'amount' => (int) ($request->amount),
//             'productinfo' => $request->productinfo,
//             'firstname' => $request->firstname,
//             'email' => $request->email,
//             'phone' => $request->phone,
//             'surl' => route('front.payment.success'),
//             'furl' => route('front.payment.fail'),
//             'hash' => $this->generateHash($merchantKey, $merchantSalt, $transactionId, $request->amount, $request->productinfo, $request->firstname, $request->email),
//         ];

//         $subTotal = Cart::subtotal(2, '.', '');
//         $shipping = 0;
//         $couponCode = null;
//         $couponCodeId = null;
//         $discount = 0;
//         $grandTotal = $subTotal;

//         // Calculate discount if applicable
//         if (Session()->has('code')) {
//             $couponCode = Session()->get('code')->code;
//             $couponCodeId = Session()->get('code')->id;
//             $code = Session()->get('code');
//             if ($code->type == 'percent') {
//                 $discount = ($code->discount_amount / 100) * $subTotal;
//             } else {
//                 $discount = $code->discount_amount;
//             }
//             $grandTotal = $subTotal - $discount; // After Discount calculation logic
//         }

//         // Get customer address
//         $customerAddress = CustomerAddress::where('user_id', $user->id)->where('default_address', 1)->first();

//         // Create new order
//         $order = new Order;
//         $order->user_id = $user->id;
//         $order->subtotal = $subTotal;
//         $order->shipping = $shipping;
//         $order->coupon_code = $couponCode;
//         $order->coupon_code_id = $couponCodeId;
//         $order->discount = $discount;
//         $order->grand_total = ($subTotal - $discount) + $shipping;
//         $order->name = $customerAddress->name;
//         $order->mobile_no = $customerAddress->mobile_no;
//         $order->address = $customerAddress->address;
//         $order->locality_town = $customerAddress->locality_town;
//         $order->city = $customerAddress->city;
//         $order->state = $customerAddress->state;
//         $order->pincode = $customerAddress->pincode;
//         $order->order_status = "pending";
//         $order->transaction_id = $transactionId;
//         $order->payment_status = "not_paid";
//         $order->save();

//         // Store order items in the order items table
//         foreach (Cart::content() as $item) {
//             $orderItem = new OrderItem;
//             $orderItem->order_id = $order->id;
//             $orderItem->product_id = $item->id;
//             $orderItem->name = $item->name;
//             $orderItem->qty = $item->qty;
//             $orderItem->price = $item->price;
//             $orderItem->total = (($item->price) * ($item->qty));
//             $orderItem->save();
//         }

//         // dd(
//         //     $data,
//         //     $order->order_status,
//         //     $transactionId,
//         //     $order->payment_status
//         // );
//         return $data;
//         // return view('payments.payu', compact('data'));
//     }

//     private function generateHash($key, $salt, $txnid, $amount, $productinfo, $firstname, $email)
//     {
//         // Construct the hash string with the required parameters
//         $hashString = $key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $firstname . '|' . $email . '|||||||||||' . $salt;

//         // Generate the hash using SHA-512
//         return strtolower(hash('sha512', $hashString));
//     }
//     public function verifyPayments()
//     {

//     }
// }