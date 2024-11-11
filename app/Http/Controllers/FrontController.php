<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $featured_products = Product::where("is_featured", "yes")
            ->orderBy('id', 'Desc')
            ->take(8)
            ->where('status', 1)
            ->get();
        $latest_products = Product::orderBy('id', 'Desc')
            ->where('status', 1)
            ->take(8)
            ->get();


        return view("front.Ytb_home", compact("featured_products", "latest_products")); // To Follow 
    }
    // public function addToWishList(Request $request)
    // {
    //     // Log request data for debugging
    //     // dd($request->all());

    //     if (!Auth::check()) {
    //         session(['url.intended' => url()->previous()]);
    //         return response()->json(['status' => false]);
    //     }

    //     // Check if the product exists before adding it to the wishlist
    //     $product = Product::find($request->id);
    //     if ($product == null) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => '<div class="alert alert-danger">Product could not be found.</div>'
    //         ]);
    //     }

    //     // Check if the product is already in the wishlist to avoid duplicates
    //     $existingWishlist = Wishlist::where('user_id', Auth::id())
    //         ->where('product_id', $request->id)
    //         ->first();

    //     if ($existingWishlist) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => '<div class="alert alert-warning">Product is already in your wishlist.</div>'
    //         ]);
    //     }

    //     // Add product to wishlist
    //     $wishlist = new Wishlist;
    //     $wishlist->user_id = Auth::id();
    //     $wishlist->product_id = $request->id;
    //     $wishlist->save();

    //     return response()->json([
    //         'status' => true,
    //         'message' => '<div class="alert alert-success">Product "' . $product->title . '" added to wishlist.</div>'
    //     ]);
    // }

    public function addToWishList(Request $request)
    {
        // Log request data for debugging if needed
        // dd($request->all());
    
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Store intended URL to redirect after login
            session(['url.intended' => url()->previous()]);
            return response()->json(['status' => false]);
        }
    
        // Check if the product exists in the database
        $product = Product::find($request->id);

        
        if ($product == null) {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-danger">Product could not be found.</div>'
            ]);
        }
    
        // Check if the product is already in the wishlist
        $existingWishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->id)
            ->first();
    
        if ($existingWishlist) {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-warning">Product is already in your wishlist.</div>'
            ]);
        }
    
        // Add the product to the wishlist
        $wishlist = new Wishlist;
        $wishlist->user_id = Auth::id();
        $wishlist->product_id = $request->id;
        $wishlist->save();
    
        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success">Product "' . $product->title . '" added to wishlist.</div>'
        ]);
    }
    
   
}
