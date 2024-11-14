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
use App\Models\Page;
use App\Models\ProductImages;
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

function getProductImage($productId)
{
return ProductImages::where('product_id', $productId)->first();
}

function getBrands()
{
    return Brand::orderBy('name', 'asc')->get();  // Fetch all brands ordered by name
}

function getCustomerAddresses()
{
    return CustomerAddress::get();
}
function orderEmail($orderId, $userType)
{
    $order = Order::with('orderItems')->where('transaction_id', $orderId)->first();

    Log::info('ORDER DETAILS : ' . $order . ' with ORDER ID : ' . $orderId . ' and USER TYPE : ' . $userType);
    // dd($userType);

    if ($userType == "customer") {
        $subject = "Thanks for your order !!!";
        $email = $order->user_email;

        Log::info('USER - TYPE : ' . $userType . ' SUBJECT : ' . $subject . ' EMAIL : ' . $email);

    } else if ($userType == "admin") {
        $subject = "You've got an order !!!";
        $email = env('ADMIN_EMAIL');
        Log::info('USER - TYPE : ' . $userType . ' SUBJECT : ' . $subject . ' EMAIL : ' . $email);
    }

    if ($order && $email) { // Check if email exists
        $maildata = [
            'subject' => $subject,
            'order' => $order,
            'userType' => $userType,
        ];

        // dd("\n User Type : " . $userType . "\n Email : \n" . $email);

        Log::info("Sending email to: " . $email);
        Mail::to($email)->send(new OrderEmail($maildata));
        Log::info("Successfully sent mail  with Txn Id : " . $orderId);
    } else {
        Log::info("Error: Unable to send email. Order not found or email missing.");
        // dd($order);
    }

   
}
function staticPages(){
    $page = Page::orderBy("name", "ASC")->get();
    return $page;
}

if (!function_exists('getUserImage')) {
    function getUserImage($userId)
    {
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];  // List of possible image extensions

        // Check for each possible extension
        foreach ($extensions as $ext) {
            $imagePath = public_path('uploads/Users/' . $userId . '.' . $ext);
            if (file_exists($imagePath)) {
                return asset('uploads/Users/' . $userId . '.' . $ext);
            }
        }

        // Return a default image if no image is found
        return asset('uploads/Users/default.jpg');
    }
}

if (!function_exists('getAdminImage')) {
    function getAdminImage($userId)
    {
        // List of possible image extensions
        $extensions = ['jpg', 'jpeg', 'png', 'gif']; 

        // Loop through each possible extension
        foreach ($extensions as $ext) {
            $imagePath = public_path('uploads/Users/' . $userId . '.' . $ext);
            if (file_exists($imagePath)) {
                return asset('uploads/Users/' . $userId . '.' . $ext);
            }
        }

        // Return a default image if no image is found
        return asset('admin-assets/img/avatar5.png');
    }
}


