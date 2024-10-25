<?php

// echo "Hello Usman";

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Section;
use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

// function getSections()
// {
// return Section::orderBy('id', 'asc')
// ->with('category')
// ->where('showhome', '=', 'Yes')
// ->get();
// }

function getSections()
{
    // Fetch sections with their respective categories and subcategories
    return Section::with('categories.subcategories')
        ->where('status', '=', 1)
        ->where('showhome', '=', 'Yes')  // Filter by 'showhome' attribute
        ->orderBy('id', 'asc')           // Order sections by ID
        ->get();                         // Retrieve the collection
}


function getCategories()
{
    return Category::orderBy('name', 'asc')
        ->with('subcategories')
        ->where('showhome', '=', 'Yes')
        ->get();
}
function getSubCategories()
{
    return SubCategory::orderBy('name', 'asc')
        ->where('showhome', '=', 'Yes')
        ->get();
}
function getProducts()
{
    return Product::orderBy('title', 'asc')
        ->where('status', '=', 'Active')
        ->get();
}

function getBrands()
{
    return Brand::orderBy('name', 'asc')->get();  // Fetch all brands ordered by name
}

function getCustomerAddresses()
{
    return CustomerAddress::get();
}
function orderEmail($orderId)
{
    $order = Order::with('orderItems')->where('id', $orderId)->first();

    if ($order && $order->user_email) { // Check if email exists
        $maildata = [
            'subject' => 'Thanks for Order',
            'order' => $order,
        ];
        // dd("\n Orders : \n". $order);

        Log::info("Sending email to: " . $order->user_email);
        Mail::to($order->user_email)->send(new OrderEmail($maildata));
        Log::info("Successfully sent mail.");
    } else {
        Log::info("Error: Unable to send email. Order not found or email missing.");
        // dd($order);
    }
}
