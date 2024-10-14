<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DiscountCoupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DiscountCodeController extends Controller
{

    public function index(Request $request)
    {
        // Start with the query builder for DiscountCoupon
        $discountCoupon = DiscountCoupon::query();

        // Apply keyword search if provided
        if (!empty($request->get("keyword"))) {
            $keyword = $request->get("keyword");
            $discountCoupon = $discountCoupon
                ->where("code", "like", "%" . $keyword . "%")
                ->orWhere("name", "like", "%" . $keyword . "%");
        }

        // Paginate the results after applying conditions
        $discountCoupon = $discountCoupon->paginate(10);

        return view("admin.coupon.list", compact("discountCoupon"));
    }

    public function create()
    {
        $categories = Category::all();
        // return view('coupons.create', compact('categories'));
        return view("admin.coupon.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'max_usage' => 'nullable|integer',
            'max_usage_user' => 'nullable|integer',
            'type' => 'required|in:percent,fixed',
            'discount_amount' => 'nullable|numeric',
            'min_amount' => 'nullable|numeric',
            'categories' => 'array|exists:categories,id',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
        ]);

        $coupon = DiscountCoupon::create($request->only([
            'code',
            'name',
            'description',
            'max_usage',
            'max_usage_user',
            'type',
            'discount_amount',
            'min_amount',
            'status',
            'starts_at',
            'expires_at'
        ]));

        // Attach selected categories
        $coupon->categories()->sync($request->categories);

        return redirect()->route('coupon.index');
    }

    public function update($couponId, Request $request)
    {
        // Find the coupon by ID
        $coupon = DiscountCoupon::find($couponId);

        // If coupon is not found, return a JSON response with error
        if (empty($coupon)) {
            session()->flash('error', 'Coupon Not Found!');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Coupon Not Found'
            ]);
        }

        // Validate the input data
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'description' => 'nullable',
            'max_usage' => 'nullable|integer',
            'max_usage_user' => 'nullable|integer',
            'type' => 'required|in:fixed,percent',
            'discount_amount' => 'required|numeric',
            'min_amount' => 'nullable|numeric',
            'status' => 'required|integer',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'categories' => 'array|exists:categories,id', // Validating the categories array
        ]);

        // If validation fails, return JSON response with errors
        if ($validator->fails()) {
            // dd($request->all());
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'errors' => $validator->errors(),
            ]);
        }

        // Update the coupon fields
        $coupon->code = $request->code;
        $coupon->name = $request->name;
        $coupon->description = $request->description;
        $coupon->max_usage = $request->max_usage;
        $coupon->max_usage_user = $request->max_usage_user;
        $coupon->type = $request->type;
        $coupon->discount_amount = $request->discount_amount;
        $coupon->min_amount = $request->min_amount;
        $coupon->starts_at = $request->starts_at;
        $coupon->expires_at = $request->expires_at;
        $coupon->status = $request->status;

        // Save the updated coupon
        $coupon->save();

        // Sync the selected categories (many-to-many relationship)
        if ($request->has('categories')) {
            $coupon->categories()->sync($request->categories);
        }

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'Coupon Has Been Updated Successfully'
        ]);

        // Alternatively, you can use a redirect if needed
        // return redirect()->route('coupon.index')->with('success', 'Coupon Has Been Updated Successfully');
    }


    public function show(string $id)
    {
        //
    }

    public function edit($couponId, Request $request)
    {
        // Find the coupon by ID
        $coupon = DiscountCoupon::with('categories')->find($couponId);

        // Check if the coupon exists
        if (empty($coupon)) {
            session()->flash('error', 'Record Not Found !!!');
            return redirect()->route('coupon.index');
        }

        // Retrieve all categories
        $categories = Category::all();

        // Pass the coupon and categories to the view
        return view('admin.coupon.edit', compact('coupon', 'categories'));
    }

    public function destroy($couponId, Request $request)
    {
        $coupon = DiscountCoupon::find($couponId); // TO Find Category By Using ID
        if (empty($coupon)) {
            // return redirect()->route('categories.index');

            session()->flash("error", "Category Could Not Be Found.");

            return response()->json([
                "status" => false,
                "message" => "Category Could Not Be Deleted Successfully."
            ]);
        }

        $coupon->delete();


        session()->flash("success", "Category Has Been Successfully Deleted.");

        return response()->json([
            "status" => true,
            "message" => "Category Has Been Deleted Successfully !",
        ]);
    }

    public function mynCoupon(Request $request)
    {
        // Get the sort parameter from the request
        $sort = $request->input('sort', 'id'); // Default sorting by ID

        // Apply sorting based on the parameter
        switch ($sort) {
            case 'trending':
                // Sort by a custom logic for trending (this could be based on views, ratings, etc.)

                // This feature is not working properly.
                $coupons = DiscountCoupon::with('categories')->orderBy('id', 'desc')->get();
                break;

            case 'discount':
                // Sort by discount amount in descending order
                $coupons = DiscountCoupon::with('categories')->orderBy('discount_amount', 'desc')->get();
                break;

            case 'expiring_soon':
                // Sort by expiry date in descending order
                $coupons = DiscountCoupon::with('categories')->orderBy('expires_at', 'desc')->get();
                break;

            case 'all':
            default:
                // Sort by ID in ascending order
                $coupons = DiscountCoupon::with('categories')->orderBy('id', 'asc')->get();
                break;
        }

        return view("front.account.mynCoupon", compact("coupons"));
    }

    public function getProductsByCategory(Request $request)
    {
        $request->validate([
            'couponCode' => 'required|string|exists:discount_coupons,code', // Ensure the coupon exists
        ], [
            'couponCode.required' => 'Please enter a coupon code.',
            'couponCode.exists' => 'The provided coupon code does not exist.',
        ]);

        $coupon = DiscountCoupon::where('code', $request->couponCode)->with('categories')->first();

        if (!$coupon) {
            return response()->json([], 404); 
        }

        $categories = $coupon->categories;

        $products = Product::with(['product_images', 'category'])
            ->whereIn('category_id', $categories->pluck('id'))
            ->get();

        $response = [
            'coupon' => [
                'code' => $coupon->code,
                'description' => $coupon->description,
                'discount_amount' => $coupon->discount_amount,
                'type' => $coupon->type,
                'min_amount' => $coupon->min_amount,
            ],
            'products' => $products,
            'categories' => $categories,
        ];

        return response()->json($response);

    }

}
