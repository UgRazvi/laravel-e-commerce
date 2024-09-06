<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Products::latest()->paginatepaginate(10);
        return view("admin.products.list");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // echo "<h1> Products Create Page </h1>";
        $data = [];
        $categories = Category::orderBy("name", 'ASC')->get();
        $brands = Brand::orderBy("name", 'ASC')->get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;

        return view("admin.products.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:products',
            'status' => 'required|in:0,1', // Ensure status is either 0 or 1
        ]);

        if ($validator->passes()) {
            $products = new Product(); // Corrected to Products
            $products->name = $request->name;
            $products->slug = $request->slug;
            $products->status = $request->status;
            $products->save();

            $request->session()->flash('success', 'Products Has Been Added Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Products Has Been Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors() // Ensure the key is 'errors' to match your JavaScript
            ]);
        }
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
