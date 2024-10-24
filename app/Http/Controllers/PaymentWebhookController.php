<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order; // Assuming you're using Order model


class PaymentWebhookController extends Controller
{
    // Handle PayU success webhook
    public function handlePayUSuccess(Request $request)
    {
        Log::info('PayU Webhook Received', $request->all());

        $data = $request->all();
        // dd($data);
        if (!$this->verifyWebhookHash($data)) {
            return response()->json(['error' => 'Invalid hash'], 400);
        }

        $order = Order::where('transaction_id', $data['txnid'])->first();

        if ($order && $data['status'] == 'success') {
            $order->update([
                'order_status' => 'delivered',
                'payment_id' => $data['payment_id'],
                'payment_status' => 'paid',
            ]);

            return response()->json(['message' => 'Webhook handled successfully'], 200);
        }

        return response()->json(['error' => 'Payment verification failed'], 400);
    }

    // Verify PayU webhook hash
    private function verifyWebhookHash($data)
    {
        $merchantSalt = env('PAYU_MERCHANT_SALT');
        $hashString = $data['transaction_id'] . '|' . $data['status'] . '|' . $merchantSalt;
        $generatedHash = strtolower(hash('sha512', $hashString));

        return $generatedHash === $data['hash'];
    }
}
