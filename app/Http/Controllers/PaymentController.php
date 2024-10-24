<?php
namespace App\Http\Controllers;

use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\PayUService;
use Illuminate\Support\Facades\Log;
use Gloudemans\Shoppingcart\Facades\Cart;

class PaymentController extends Controller
{
    private $payUService;

    public function __construct(PayUService $payUService)
    {
        $this->payUService = $payUService;
    }

    public function pay(Request $request)
    {
        $data = $this->payUService->pay($request);
        return view('payments.payu', compact('data'));
    }

    // Handle the front-end success redirect, only redirect to thank you page
    public function success(Request $request)
    {
        Log::info('Payment success redirect received', $request->all());

        $txnId = $request->input('txnid');
        return redirect()->route('front.thank', $txnId);
    }

    public function fail(Request $request)
    {
        $txnId = $request->input('txnid');

        $order = Order::where('transaction_id', $txnId)->first();

        if ($order) {
            // Set order status to 'failed'
            $order->order_status = 'pending';
            $order->payment_status = 'not_paid';
            $order->save();
        }

        session()->flash("error", "Your payment failed. Please try again.");
        return redirect()->route('front.checkout');
    }
}


// class PaymentController extends Controller
// {
//     private $payUService;

//     public function __construct(PayUService $payUService)
//     {
//         $this->payUService = $payUService;
//     }

//     public function pay(Request $request)
//     {
//         // dd($request->all());
//         $data = $this->payUService->pay($request);
//         //  dd($data);
//         return view('payments.payu', compact('data'));
//     }


//     public function success(Request $request){
//         // dd($request->all())
//         // Retrieve the transaction ID from PayU's response
//         $txnId = $request->input('txnid'); // PayU transaction ID

//         // Assuming your order table has a 'transaction_id' or similar field
//         $order = Order::where('transaction_id', $txnId)->first();

//         if ($order) {
//             // Update order status to 'paid'
//             $order->order_status = 'shipped'; // Or a relevant status like 'completed'
//             $order->payment_status = 'paid'; // Optionally, to track payment success
//             // dd($order->order_status, $order->payment_status);
//             $order->save();

//             // Optionally, clear the cart if you want after payment success
//             Cart::destroy();
//         }

//         // Redirect to a thank you page with the transaction ID
//         return redirect()->route('front.thank', $txnId);
//     }


//     public function fail(Request $request)
//     {
//         // Retrieve the transaction ID from PayU's response
//         $txnId = $request->input('txnid'); // PayU transaction ID

//         // Assuming your order table has a 'transaction_id' or similar field
//         $order = Order::where('transaction_id', $txnId);

//         if ($order) {
//             // Update order status to 'failed'
//             $order->order_status = 'pending'; // Or relevant status like 'cancelled'
//             $order->payment_status = 'not_paid'; // Optionally, to track payment failure
//             $order->save();
//         }

//         // Flash an error message and redirect to the checkout page
//         session()->flash("error", "Your payment failed. Please try again.");
//         return redirect()->route('front.checkout');
//     }

// }
