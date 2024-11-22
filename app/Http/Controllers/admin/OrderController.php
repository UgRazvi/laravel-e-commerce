<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
{
    // Start with the base query for orders
    $orders = Order::with(["orderItems", 'orderItems.product', 'orderItems.product.product_images'])
                   ->orderBy('id', 'ASC');

        // if ($keyword = $request->get("keyword")) 
        // {    $orders->where(function ($query) use ($keyword) {
        //         // Existing search criteria for orders table
        //         $query->where("orders.name", "like", "%{$keyword}%")
        //             ->orWhere("orders.subtotal", "like", "%{$keyword}%")
        //             ->orWhere("orders.coupon_code", "like", "%{$keyword}%")
        //             ->orWhere("orders.mobile_no", "like", "%{$keyword}%")
        //             ->orWhere("orders.address", "like", "%{$keyword}%")
        //             ->orWhere("orders.locality_town", "like", "%{$keyword}%")
        //             ->orWhere("orders.city", "like", "%{$keyword}%")
        //             ->orWhere("orders.state", "like", "%{$keyword}%")
        //             ->orWhere("orders.pincode", "like", "%{$keyword}%")
        //             ->orWhere("orders.order_status", "like", "%{$keyword}%")
        //             ->orWhere("orders.payment_status", "like", "%{$keyword}%")
        //             ->orWhere("orders.transaction_id", "like", "%{$keyword}%")
        //             ->orWhere("orders.grand_total", "like", "%{$keyword}%");

        //         // Join with order_items table and add search criteria for it
        //         $query->orWhereHas('orderItems', function ($subQuery) use ($keyword) {
        //             $subQuery->where("order_items.name", "like", "%{$keyword}%");
        //         });
        //     });
        // }

    // Check if start_date and end_date are provided in the request
    if ($request->has('start_date') && $request->has('end_date')) {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filter orders within the given date range (ensure proper date format)
        $orders = $orders->whereBetween('created_at', [$startDate, $endDate]);
    }

    // Apply pagination if necessary
    $orders = $orders->get();

    // Return the filtered orders to the view
    return view("admin.orders.list", compact("orders"));
}


    public function sendInvoiceEmail(Request $request, $orderId)
    {
        // echo "HEllo $orderId";
        // dd($request->userType);
        orderEmail($orderId, $request->userType);

        $message = "Email sent to : " . $request->userType . " With Order Id : " . $orderId . " successfully";
        Log::info("Email sent to : " . $request->userType . " With Order Id : " . $orderId . " successfully");

        session()->flash('sucess', $message);
        return response([
            'status' => true,
            'message' => $message,
        ]);
    }

    public function updatePaymentStatus(Request $request, $orderId) {
        // Find the order by its ID
        $order = Order::where('transaction_id', $orderId);
    
        // dd($order);
        // Check if the order exists
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
    
        // Validate the incoming request data
        $request->validate([
            'status' => 'required|string|in:pending,shipped,delivered', // Adjust as necessary
        ]);
    
        try {
            // Update the order status and payment status based on the request
            $order->update([
                'order_status' => $request->input('status'), // Use the status from the request
                'payment_status' => $request->input('status') === 'pending' ? 'not_paid' : 'paid', // Set payment_status based on order status
            ]);
            Log::info('OrderController - Order Updated Successfully', ['order_id' => $orderId]);
    
            // Send Invoice E-Mail to Customer
            if($request->input('status') === 'pending'){

            }else{
                orderEmail($orderId, "customer");
                return response()->json(['message' => 'E-Mail Sent Successfully with Order ID : '. $orderId], 200);
            }
            
            return response()->json(['message' => 'Order status updated successfully'], 200);

        } catch (\Exception $e) {
            Log::error('Order Controller - Order Update Failed: ' . $e->getMessage());
            return response()->json(['message' => 'Order updation Complete !'], 500);
        }
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $orderId)
    {
        $order = Order::with(["orderItems", 'orderItems.product', 'orderItems.product.product_images'])->find($orderId);

        // dd("Order Data : " , $order);

        return view("admin.orders.show", compact("order"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($orderId, Request $request)
    {
        // Find the order with related items, products, and product images
        $order = Order::with(['orderItems.product.product_images'])->find($orderId);

        // Check if order exists
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found....!!!');
        }

        return view('admin.orders.edit', compact('order'));
    }


}
