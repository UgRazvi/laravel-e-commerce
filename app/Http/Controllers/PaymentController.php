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
        // dd($request);
        $data = $this->payUService->pay($request);
        return view('payments.payu', compact('data'));
    }

    // Handle the front-end success redirect, only redirect to thank you page
    public function success(Request $request)
    {
        Log::info('Payment success request received', $request->all());
        $txnId = $request->input('txnid');

        if (!$txnId) {
            return redirect()->route('front.cart')->with('error', 'Transaction ID is missing.');
        }

        return redirect()->route('front.thank', ['txnId' => $txnId]);
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
