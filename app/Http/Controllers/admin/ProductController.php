<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\TempImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::latest()->with('product_images');

        if ($keyword = $request->get("keyword")) {
            $products = $products->where(
                function ($query) use ($keyword) {
                    $query->where("title", "like", "%{$keyword}%")
                        ->orWhere("sku", "like", "%{$keyword}%")
                        ->orWhere("price", "like", "%{$keyword}%");
                }
            );
        }
        $products = $products->paginate(10);

        // dd($products); // For Debugging Purpose Only (-  #Removable-Content )
        return view("admin.products.list", compact("products")); // Sending Data To View Using "compact()" function.
        // return view("admin.products.list");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::orderBy("name", "asc")->get();
        // $subcategories = SubCategory::orderBy("name","asc")->get();
        $brands = Brand::orderBy("name", "asc")->get();
        return view("admin.products.create", compact("categories", "brands"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // dd($request->image_array); // For Debugging Purpose Only.
        // exit(); // For Debugging Purpose Only.

        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',

            // 'status' => 'required|in:0,1', // Ensure status is either 0 or 1
        ];


        // Dynamically adding 'qty' rule based on track_qty value
        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            $product = new Product;
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->track_qty = $request->track_qty;
            $product->track_qty = $request->track_qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            // $product->is_downloadable = $request->is_downloadable;
            $product->save();
            // Product::create($request->only[""]); // optional Method.

            // Save Product Images Permanently From Temporary Image Array.
            if (!empty($request->image_array)) {
                foreach ($request->image_array as $temp_image_id) {

                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.', $tempImageInfo->name);
                    $ext = last($extArray);

                    $productImage = new ProductImages();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();

                    $imageName = $product->id . '-' . $productImage->id . '.' . $ext;

                    $sPath = public_path('/tempImgs/' . $tempImageInfo->name);
                    $dPath = public_path('/uploads/Products/' . $imageName);

                    File::move($sPath, $dPath);

                    $productImage->image = $imageName;

                    $productImage->save();
                }
            }

            session()->flash('success', 'Your Product Has Been Added Succesfully.');

            return response()->json([
                'status' => true,
                'message' => 'Great. Your Product Has Been Updated Sucessfully.'
                // 'errors' => $validator->errors(),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                // 'message' => 'Sorry Product Could Not Be Added. It Might Be Already Present. Please Check Once Againg'
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
    public function edit($productId, Request $request)
    {
        $product = Product::find($productId);
        if (empty($product)) {
            return redirect()->route('products.index')->with('error', 'Product not found....!!!');
        }
        // Fetch Product Images
        $productImages = ProductImages::where('product_id', $product->id)->get();

        // echo $productId; // Testing Purpose
        $categories = Category::orderBy("name", "asc")->get();
        $subcategories = SubCategory::where("category_id", $product->category_id)->get();
        // dd($subcategories);
        $brands = Brand::orderBy("name", "asc")->get();
        $product = Product::find($productId);

        return view('admin.products.edit', compact('product', 'brands', 'categories', 'subcategories', 'productImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {

        // dd($request->image_array); // For Debugging Purpose Only.
        // exit(); // For Debugging Purpose Only.

        $product = Product::find($id);
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id . ',id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,' . $product->id . ',id',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',

            // 'status' => 'required|in:0,1', // Ensure status is either 0 or 1
        ];


        // Dynamically adding 'qty' rule based on track_qty value
        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            // $product = new Product; // Already present 
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->track_qty = $request->track_qty;
            $product->track_qty = $request->track_qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            // $product->is_downloadable = $request->is_downloadable;
            $product->save();

            if (!empty($request->image_array)) {
                foreach ($request->image_array as $temp_image_id) {

                    $tempImageInfo = TempImage::find($temp_image_id);

                    if (!$tempImageInfo) {
                        // Handle the case where the image is not found
                        return response()->json([
                            'status' => false,
                            'message' => "Temporary image with ID $temp_image_id not found."
                        ], 404);
                    }

                    $extArray = explode('.', $tempImageInfo->name);
                    $ext = last($extArray);

                    $productImage = new ProductImages();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();

                    $imageName = $product->id . '-' . $productImage->id . '.' . $ext;

                    $sPath = public_path('/tempImgs/' . $tempImageInfo->name);
                    $dPath = public_path('/uploads/Products/' . $imageName);

                    File::move($sPath, $dPath);

                    $productImage->image = $imageName;

                    $productImage->save();
                    // File::delete(public_path("/uploads/Products/$tempImageInfo"));
                }
            }

            session()->flash('success', 'Your Product Has Been Updated Succesfully.');

            return response()->json([
                'status' => true,
                'message' => 'Great. Your Product Has Been Updated Sucessfully.'
                // 'errors' => $validator->errors(),
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                // 'message' => 'Sorry Product Could Not Be Added. It Might Be Already Present. Please Check Once Againg'
            ]);
        }
    }
    public function destroy($productId, Request $request)
    {
        $product = Product::find($productId); // Find Product by ID
        if (empty($product)) {
            session()->flash("error", "Product Could Not Be Found.");

            return response()->json([
                "status" => false,
                "notFound" => true,
                "message" => "Product Could Not Be Deleted Successfully."
            ]);
        }

        // Fetch associated images
        $productImages = ProductImages::where("product_id", $productId)->get();

        if (!empty($productImages)) {
            foreach ($productImages as $productImage) {
                // Ensure you use the correct image path
                $imagePath = public_path("/uploads/Products/" . $productImage->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath); // Delete each image from storage
                }
            }
            ProductImages::where("product_id", $productId)->delete(); // Delete from the database
        }

        $product->delete(); // Delete the product

        session()->flash("success", "Product Has Been Successfully Deleted.");

        return response()->json([
            "status" => true,
            "message" => "Product Has Been Deleted Successfully!",
        ]);
    }

    // public function destroy($productId, Request $request)
    // {
    //     $product = Product::find($productId); // TO Find Product By Using ID
    //     if (empty($product)) {
    //         // return redirect()->route('categories.index');

    //         session()->flash("error", "Product Could Not Be Found.");

    //         return response()->json([
    //             "status" => false,
    //             "notFound" => true,
    //             "message" => "Product Could Not Be Deleted Successfully."
    //         ]);
    //     }

    //     $productImages = ProductImages::where("product_id", $productId)->get();
        
    //     if (!empty($productImages)) {
    //         foreach ($productImages as $productImage) {
    //             File::delete(public_path("/uploads/Products/$product->image"));
    //         }
    //         ProductImages::where("product_id", $productId)->delete();
    //     }
    //     // File::delete(public_path("/tempImgs/$product->image"));

    //     $product->delete();


    //     session()->flash("success", "Product Has Been Successfully Deleted.");

    //     return response()->json([
    //         "status" => true,
    //         "message" => "Product Has Been Deleted Successfully !",
    //     ]);
    // }
}