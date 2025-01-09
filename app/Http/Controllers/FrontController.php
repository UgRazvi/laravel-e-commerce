<?php

namespace App\Http\Controllers;

use App\Models\Page;
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

        $featured_products = Product::with('product_ratings')->where("is_featured", "yes")
            ->orderBy('id', 'ASC')
            // ->take(8)
            ->where('status', 1)
            ->get();
        $latest_products = Product::with('product_ratings')->orderBy('id', 'ASC')
            ->where('status', 1)
            // ->take(8)
            ->get();
// dd($featured_products, $latest_products);

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
        if (!Auth::check()) {
            session(['url.intended' => url()->previous()]);
            return response()->json(['status' => false]);
        }
        $product = Product::find($request->id);

        
        if ($product == null) {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-danger">Product could not be found.</div>'
            ]);
        }
        $existingWishlist = Wishlist::where('user_id', Auth::id())
            // ->where('product_id', $request->id)
            // ->first();
            ->firstWhere('product_id', $request->id);
    
        if ($existingWishlist) {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-warning">Product is already in your wishlist.</div>'
            ]);
        }
    
        $wishlist = new Wishlist;
        $wishlist->user_id = Auth::id();
        $wishlist->product_id = $request->id;
        $wishlist->save();
    
        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success">Product "' . $product->title . '" added to wishlist.</div>'
        ]);
    }
    
    public function page($slug){
        $page = Page::where('slug', $slug)->first();
        // dd($page->status);

        if($page->status == 1){
            return view("front.page", compact("page"));
        }else{
            abort(404);  // Redirect to the 404 error page
        }
    }
   
}
