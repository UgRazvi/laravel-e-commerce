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
        // dd($data); // Uncomment for debugging
        if (!$this->verifyWebhookHash($data)) {
            return response()->json(['error' => 'Invalid hash'], 400);
        }

        $order = Order::where('transaction_id', $data['txnid']);

        if ($order && $data['status'] == 'success') {
            try {
                $order->update([
                    'order_status' => 'delivered',
                    'payment_status' => 'paid',
                ]);
                Log::info('Order Updated Successfully');

                // SEnd Invoice E-Mail to Customer.
                orderEmail($data['txnid'], "customer");
                // Log::info('Invoice E-Mail Sent To User : '. $data['name'] - $data['user_email'].' Successfully with TXN ID : '. $data['txnid']);

            } catch (\Exception $e) {
                Log::error('Order Update Failed: ' . $e->getMessage());
            }

            return response()->json(['message' => 'Webhook handled successfully'], 200);
        }
        // dd("Error");
        return response()->json(['error' => 'Payment verification failed'], 400);
    }

    // Verify PayU webhook hash
    private function verifyWebhookHash($data)
    {

        $udf1 = $data['udf1'] ?? ''; // Handle UDFs as empty if null
        $udf2 = $data['udf2'] ?? '';
        $udf3 = $data['udf3'] ?? '';
        $udf4 = $data['udf4'] ?? '';
        $udf5 = $data['udf5'] ?? '';

        $merchantSalt = env('PAYU_MERCHANT_SALT');

        // sha512(SALT|status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key)

        $hashString = $merchantSalt . '|' . $data['status'] . '||||||' . $udf5 . '|' . $udf4 . '|' . $udf3 . '|' . $udf2 . '|' . $udf1 . '|' . $data['email'] . '|' . $data['firstname'] . '|' . $data['productinfo'] . '|' . $data['amount'] . '|' . $data['txnid'] . '|' . $data['key'];


        $generatedHash = strtolower(hash('sha512', $hashString));

        // Log both hashes for debugging
        Log::info("\n\n\t Generated Hash: " . $generatedHash . "\n");
        Log::info("\n\n\t Received Hash: " . $data['hash'] . "\n");

        return $generatedHash === $data['hash'];
    }
}
