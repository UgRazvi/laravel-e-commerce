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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;



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



function getLogo()
{
    // Query the 'themes' table to get the logo file name
    $logo = DB::table('themes')->where('key', 'logo')->value('value'); // Assuming 'logo' is stored in 'value' column

    // If logo exists, return the full URL using asset() function
    if ($logo) {
        return asset('uploads/Themes/' . $logo); // Assuming 'logo' is stored as 'image_name.ext'
    }

    // If logo doesn't exist, return a default image or null
    return asset('uploads/Themes/default-logo.png'); // Provide a fallback logo path
}
function getFavicon()
{
    // Query the 'themes' table to get the logo file name
    $favicon = DB::table('themes')->where('key', 'favicon')->value('value'); // Assuming 'logo' is stored in 'value' column

    // If favicon exists, return the full URL using asset() function
    if ($favicon) {
        return asset('uploads/Themes/' . $favicon); // Assuming 'Favicon' is stored as 'image_name.ext'
    }

    // If favicon doesn't exist, return a default image or null
    return asset('uploads/Themes/default-logo.png'); // Provide a fallback logo path
}

function getTheme()
{
    $theme = DB::table('themes')->where('key', 'theme_clr')->value('value'); // Assuming 'theme_clr' is stored in 'value' column
    return $theme; 
}
function getDanger()
{
    $danger = DB::table('themes')->where('key', 'theme_base')->value('value'); // Assuming 
    return $danger; 
}



function getPrimary (){
    $bs_primary = DB::table('themes')->where('key', 'bs_primary')->value('value');
    return $bs_primary;
}  
function getPrimaryHover (){
    $bs_primary_hover = DB::table('themes')->where('key', 'bs_primary_hover')->value('value');
    return $bs_primary_hover;
}  

function getBsgray (){
    $bs_gray = DB::table('themes')->where('key', 'bs_gray')->value('value');
    return $bs_gray;
}  

function getBssecondary (){
    $bs_secondary = DB::table('themes')->where('key', 'bs_secondary')->value('value');
    return $bs_secondary;
}  

function getBssuccess (){
    $bs_success = DB::table('themes')->where('key', 'bs_success')->value('value');
    return $bs_success;
}  

function getBsinfo (){
    $bs_info = DB::table('themes')->where('key', 'bs_info')->value('value');
    return $bs_info;
}  

function getBswarning (){
    $bs_warning = DB::table('themes')->where('key', 'bs_warning')->value('value');
    return $bs_warning;
}  

function getBsdanger (){
    $bs_danger = DB::table('themes')->where('key', 'bs_danger')->value('value');
    return $bs_danger;
}  

function getBslight (){
    $bs_light = DB::table('themes')->where('key', 'bs_light')->value('value');
    return $bs_light;
}  

function getBsdark (){
    $bs_dark = DB::table('themes')->where('key', 'bs_dark')->value('value');
    return $bs_dark;
}  

function getBl_yellow (){
    $clr_yellow = DB::table('themes')->where('key', 'clr_yellow')->value('value');
    return $clr_yellow;
}  

// $bs_danger = "#dc3545";