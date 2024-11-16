<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     // Start the query
    //     $ratings = ProductRating::with('product')->get(); // Eager load the 'product' relationship
        
    //     // Check if there is a keyword search
    //     if ($keyword = $request->get("keyword")) {
    //         $ratings = $ratings->where(function ($query) use ($keyword) {
    //             // Existing search criteria for product_ratings table
    //             $query->where("product_ratings.username", "like", "%{$keyword}%")
    //                 ->orWhere("product_ratings.email", "like", "%{$keyword}%")
    //                 ->orWhere("product_ratings.status", "like", "%{$keyword}%")
    //                 ->orWhere("product_ratings.rating", "like", "%{$keyword}%")
    //                 ->orWhere("product_ratings.comment", "like", "%{$keyword}%");
    //         });
    //     }
    
    //     return view("admin.Rating.list", compact("ratings"));
    // }
    public function index(Request $request)
{
    // Start the query, eager load the product relationship
    $ratings = ProductRating::with('product')->get(); // Eager load the 'product' relationship
// dd($ratings);
    // Apply search filters if there's a keyword
    if ($keyword = $request->get("keyword")) {
        $ratings = $ratings->where(function ($query) use ($keyword) {
            $query->where("product_ratings.username", "like", "%{$keyword}%")
                ->orWhere("product_ratings.email", "like", "%{$keyword}%")
                ->orWhere("product_ratings.status", "like", "%{$keyword}%")
                ->orWhere("product_ratings.rating", "like", "%{$keyword}%")
                ->orWhere("product_ratings.comment", "like", "%{$keyword}%");
        });
    }

    // Get the results (you can use paginate instead of get if you want pagination)
    // $ratings = $ratings->get();  // or ->paginate(10); for pagination

    return view("admin.Rating.list", compact("ratings"));
}

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.Rating.create");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ratingId, Request $request)
    {
        // dd($ratingId, $request->all()); 

        // Find the order with related items, products, and product images
        $rating = ProductRating::find($ratingId);
        // dd($rating);
        $product = Product::with('product_images')->where('id', $rating->product_id)->first();
        // dd($product);
        // Check if order exists
        if (!$rating) {
            return redirect()->route('rating.index')->with('error', 'Rating not found....!!!');
        }

        return view('admin.Rating.edit', compact('rating', 'product'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function updateStatus(Request $request, $ratingId)
    {
        // dd($request, $ratingId, $request->status);
        // Find the rating by ID
        $rating = ProductRating::find($ratingId);

        // Check if the rating exists
        if (!$rating) {
            return redirect()->route('rating.index')->with('error', 'Rating not found.');
        }

        // Validate the request
        $request->validate([
            'status' => 'required',
        ]);

        // Update the status of the rating
        $rating->status = $request->status;
        $rating->save();

        // Redirect back with success message
        return redirect()->route('rating.index')->with('success', 'Rating status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
