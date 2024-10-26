<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session; // Ensure Session is imported

class ProcessPaymentService
{
    public function processPaymentCOD($request)
    {
        $user = Auth::user();

        // Check if payment method is COD
        if ($request->payment_method == 'COD') {
            $subTotal = Cart::subtotal(2, '.', '');

            $shipping = 0;
            $couponCode = null;
            $couponCodeId = null;
            $discount = 0;
            $grandTotal = $subTotal;

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

            // Flash success message
            session()->flash("success", "Hey <strong>$user->name</strong> You've successfully placed your order via COD. <br> Your Order ID : " . $order->id);
            // Cart::destroy();

            return response()->json([
                'status' => true,
                'message' => 'You Selected COD.',
                'orderId' => $order->id,
            ]);
        }
    }

  
}
