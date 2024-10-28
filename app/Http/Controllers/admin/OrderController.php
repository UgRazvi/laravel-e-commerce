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
        $orders = Order::with(["orderItems", 'orderItems.product', 'orderItems.product.product_images'])->orderBy('id', 'ASC');

        // dd($orders->first()->orderItems()->first()->product->product_images()->first());

        // If there is a search keyword, apply it to the query
        if ($keyword = $request->get("keyword")) {
            $orders->where(function ($query) use ($keyword) {
                // Existing search criteria for orders table
                $query->where("orders.name", "like", "%{$keyword}%")
                    ->orWhere("orders.subtotal", "like", "%{$keyword}%")
                    ->orWhere("orders.coupon_code", "like", "%{$keyword}%")
                    ->orWhere("orders.mobile_no", "like", "%{$keyword}%")
                    ->orWhere("orders.address", "like", "%{$keyword}%")
                    ->orWhere("orders.locality_town", "like", "%{$keyword}%")
                    ->orWhere("orders.city", "like", "%{$keyword}%")
                    ->orWhere("orders.state", "like", "%{$keyword}%")
                    ->orWhere("orders.pincode", "like", "%{$keyword}%")
                    ->orWhere("orders.order_status", "like", "%{$keyword}%")
                    ->orWhere("orders.payment_status", "like", "%{$keyword}%")
                    ->orWhere("orders.transaction_id", "like", "%{$keyword}%")
                    ->orWhere("orders.grand_total", "like", "%{$keyword}%");

                // Join with order_items table and add search criteria for it
                $query->orWhereHas('orderItems', function ($subQuery) use ($keyword) {
                    $subQuery->where("order_items.name", "like", "%{$keyword}%");
                });
            });
        }


        // Apply pagination on the query and fetch the results
        $orders = $orders->get();

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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
