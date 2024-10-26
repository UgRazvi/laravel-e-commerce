<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start with the base query for orders
        $orders = Order::with(['orderItems.product', 'orderItems.product.product_images'])->orderBy('created_at', 'DESC');

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
    public function show(string $id)
    {
        return view("orders.show", compact("id"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
