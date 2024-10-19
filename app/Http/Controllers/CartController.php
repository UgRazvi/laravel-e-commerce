<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\ProcessPaymentService;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    private $processPaymentService;

    public function __construct(ProcessPaymentService $processPaymentService)
    {
        $this->processPaymentService = $processPaymentService;
    }


    public function addToCart(Request $request)
    {
        // Fetch the product along with images
        $product = Product::with('product_images')->find($request->id);

        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product Not Found',
            ]);
        }

        // Check if the product already exists in the cart
        $productInCart = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->id;
        })->first();

        if ($productInCart) {
            // Product already exists in the cart
            $status = false;
            $message = $product->title . " already exists in the Cart";
        } else {
            // Get the first product image or set a placeholder
            $productImage = $product->product_images->first() ?? '';

            // Add the product to the cart
            Cart::add(
                $product->id,
                $product->title,
                1,
                $product->price,
                ['productImage' => $productImage]
            );

            $status = true;
            $message = "<strong>" . $product->title . " </strong> added to the Cart";
            session()->flash('success', $message);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;


        //Check Quantity Available in the Stock.
        $itemInfo = Cart::get($rowId);
        $product = Product::find($itemInfo->id);
        if ($product->track_qty == 'Yes') {
            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $status = true;
                $message = 'Cart quantity updated successfully.';
                session()->flash('success', $message);
            } else {
                $status = false;
                $message = 'Requested quantity (' . $qty . ') is not available in the Stock.';
                session()->flash('error', $message);
            }
        } else {
            Cart::update($rowId, $qty);
            $status = true;
            $message = 'Cart quantity updated successfully.';
            session()->flash('success', $message);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function deleteItem(Request $request)
    {
        $rowId = $request->rowId;
        $itemInfo = Cart::get($rowId);

        if ($itemInfo == null) {
            $status = false;
            $message = 'Product not found in the Cart.';
            session()->flash('error', $message);

            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        } else {
            Cart::remove($request->rowId);
            $status = true;
            $message = 'Product has been successfully removed from the Cart.';
            session()->flash('success', $message);

            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }
    }
    public function deleteMultipleItems(Request $request)
    {
        $items = $request->items;

        if (empty($items)) {
            return response()->json([
                'status' => false,
                'message' => 'No items selected to delete.'
            ]);
        }

        // Loop through selected items and remove them from the cart
        foreach ($items as $rowId) {
            $itemInfo = Cart::get($rowId);

            if ($itemInfo != null) {
                Cart::remove($rowId);  // Remove each item
            }
        }

        $status = true;
        $message = 'Selected items have been successfully deleted from the Cart.';

        return response()->json([
            'status' => $status,
            'message' => $message,
            'cartCount' => Cart::count()  // Return the updated cart count
        ]);
    }

    public function payment()
    {
        if (Cart::count() == 0) {
            // return redirect()->route('front.cart');
            return redirect()->route('front.cart')
                ->with("error", "You don't have any product in your cart yet.");
        }
        if (Auth::check() == false) {

            if (!session()->has("url.intended")) {
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('account.login')
                ->with("error", "You're not logged. Please Log In first to access this page.");
        }

        session()->forget("url.intended");

        return view("front.payment");

    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();

        // Step : 1 - Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'mobile_no' => 'required|numeric|digits:10',
            'pincode' => 'required|numeric|digits:6',
            'address' => 'required|string|min:5|max:255',
            'locality_town' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'type' => 'required|in:home,work',  // Home or work
            'default_address' => 'boolean',  // Check for boolean value
        ]);

        // Check if validation passes
        if ($validator->fails()) {

            // Return validation errors if validation fails
            return response()->json([
                'message' => 'Please fix the errors',
                'status' => false,
                'errors' => $validator->errors(),
            ]);

        }

        // Step : 2 - Save USer Address
        // If the current address is marked as default, unset the default for existing addresses
        if ($request->default_address == 1) {
            CustomerAddress::where('user_id', $user->id)
                ->update(['default_address' => 0]); // Unset existing default addresses
        }

        // Create the new address
        CustomerAddress::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'pincode' => $request->pincode,
            'address' => $request->address,
            'locality_town' => $request->locality_town,
            'city' => $request->city,
            'state' => $request->state,
            'type' => $request->type,
            'default_address' => $request->default_address, // Store as 1 or 0
        ]);

        // Optionally, redirect or return response
        return response()->json(['message' => 'Address added successfully.']);
        // return redirect()->route('front.checkout')->with("success", "Hey,</strong> {$request->name} <strong> , your address has been added successfully.");

        // Alternative Way to Insert Once, Then UpdateOnly. 
        // CustomerAddress::updateOrCreate(
        //     ['user_id' => $user->id],
        //     [
        //         'user_id' => $user->id,
        //         'name' => $request->name,
        //         'mobile_no' => $request->mobile_no,
        //         'pincode' => $request->pincode,
        //         'address' => $request->address,
        //         'locality_town' => $request->locality_town,
        //         'city' => $request->city,
        //         'state' => $request->state,
        //         'type' => $request->type,
        //         'default_address' => $request->default_address,
        //     ]
        // );

    }

    public function processPayment(Request $request)
    {
        return $this->processPaymentService->processPayment($request);
    }

    // public function processPayment(Request $request)
    // {
    //     $user = Auth::user();

    //     // Step : 03 - Store Data in Orders Table
    //     if ($request->payment_method == 'COD') {
    //         $subTotal = Cart::subtotal(2, '.', '');

    //         $shipping = 0;
    //         $couponCode = null;
    //         $couponCodeId = null;
    //         $discount = 0;
    //         $grandTotal = $subTotal = Cart::subtotal(2, '.', '');

    //         if (Session()->has('code')) {
    //             $couponCode = Session()->get('code')->code;
    //             $couponCodeId = Session()->get('code')->id;
    //             $code = Session()->get('code');
    //             if ($code->type == 'percent') {
    //                 $discount = ($code->discount_amount / 100) * $subTotal;
    //             } else {
    //                 $discount = $code->discount_amount;
    //             }
    //             $grandTotal = $subTotal - $discount; // After Discount calculation logic
    //         }

    //         $customerAddress = CustomerAddress::where('user_id', $user->id)->where('default_address', 1)->first();
    //         $order = new Order;
    //         $order->user_id = $user->id;
    //         $order->subtotal = $subTotal;
    //         $order->shipping = $shipping;
    //         $order->coupon_code = $couponCode;
    //         $order->coupon_code_id = $couponCodeId;
    //         $order->discount = $discount;
    //         $order->grand_total = ($subTotal - $discount) + $shipping;
    //         $order->name = $customerAddress->name;
    //         $order->mobile_no = $customerAddress->mobile_no;
    //         $order->address = $customerAddress->address;
    //         $order->locality_town = $customerAddress->locality_town;
    //         $order->city = $customerAddress->city;
    //         $order->state = $customerAddress->state;
    //         $order->pincode = $customerAddress->pincode;
    //         $order->save();

    //         // Step : 04 - Store Order Items In Order Items Table.
    //         foreach (Cart::content() as $item) {
    //             $orderItem = new OrderItem;
    //             $orderItem->order_id = $order->id;
    //             $orderItem->product_id = $item->id;
    //             $orderItem->name = $item->name;
    //             $orderItem->qty = $item->qty;
    //             $orderItem->price = $item->price;
    //             $orderItem->total = (($item->price) * ($item->qty));
    //             $orderItem->save();
    //         }

    //         session()->flash("success", "Hey <strong>$user->name</strong> You've successfully placed your order via COD. <br> Your Order ID : " . $order->id);

    //         // return redirect()->route('front.checkout')->with("success", "Hey <strong>$user->name</strong> You've successfully placed your order.");
    //         Cart::destroy();
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'You Selected COD.',
    //             'orderId' => $order->id,
    //         ]);

    //     } else if ($request->payment_method == 'UPI') {
    //         return response()->json(['message' => 'You Selected UPI.']);
    //     } else {
    //         return response()->json(['message' => 'Please Select Any Payment Option...']);
    //     }
    // }

    public function thank($id)
    {
        return view("front.thank", compact("id"));
    }

    public function cart()
    {
        // dd(Cart::content()); // For testing purpose.
        $user = Auth::user();

        $cartContent = Cart::content();

        $discount = 0;
        // $customerAddress = CustomerAddress::where('user_id', $user->id)->first();
        $grandTotal = Cart::subtotal(2, '.', '');

        // dd($cartContent);
        return view("front.cart", compact('cartContent', "discount", "grandTotal"));
    }
    public function checkout()
    {
        $user = Auth::user();
        $discount = 0;
        if (Cart::count() == 0) {
            // return redirect()->route('front.cart');
            return redirect()->route('front.cart')
                ->with("error", "You don't have any product in your cart yet.");
        }

        if (Auth::check() == false) {

            if (!session()->has("url.intended")) {
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('account.login')
                ->with("error", "You're not logged. Please Log In first to access this page.");
        }

        $customerAddress = CustomerAddress::where('user_id', $user->id)->first();

        session()->forget("url.intended");

        // $subTotal = Cart::subtotal(2, '.', '');
        $grandTotal = $subTotal = Cart::subtotal(2, '.', '');

        if (Session()->has('code')) {
            $code = Session()->get('code');
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
            $grandTotal = $subTotal - $discount; // After Discount calculation logic
        }


        return view("front.checkout", compact("customerAddress", "discount", "grandTotal"));

    }

    public function getOrderSummary(Request $request)
    {
        $grandTotal = $subTotal = Cart::subtotal(2, '.', '');
        $discount = 0;

        if (Session()->has('code')) {
            $code = Session()->get('code');
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
            $grandTotal = $subTotal;  // Before Discount calculation

            $grandTotal = $subTotal - $discount; // After Discount calculation logic


            $discountString = '<div id="cancelCouponBox"
                                     class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                     <span class="mb-2 mb-sm-0">Cancel Coupon Code:</span>
                                     <a href="" id="cancelCoupon" class="btn btn-sm btn-outline-danger">
                                         <i class="fa fa-times"></i>
                                     </a>
                
                                </div>';
        }
        return response()->json([
            'status' => true,
            'subTotal' => number_format($subTotal, 2),
            'discount' => number_format($discount, 2),
            'grandTotal' => number_format($grandTotal, 2),
            // 'discountString' => $discountString,
            // 'shippingCharge'  => number_format($shippingCharges, 2), 
        ]);
    }

    public function applyDiscount(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $reqCode = $request->code;
        $now = Carbon::now();

        $code = DiscountCoupon::where('code', $reqCode)->first();

        if ($code == null) {
            return response()->json([
                'status' => false,
                'message' => "Invalid Discount Coupon : $reqCode",
                'code' => $reqCode,
            ]);
        }

        if ($code->starts_at != "") {
            $startDate = Carbon::createFromFormat("Y-m-d H:i:s", $code->starts_at); // Corrected format
            if ($now->lt($startDate)) {
                return response()->json([
                    'status' => false,
                    'message' => "The Coupon Code ($reqCode) Doesn't Started Yet ($now).",
                    'code' => $reqCode,
                ]);
            }
        }
        if ($code->expires_at != "") {
            $endDate = Carbon::createFromFormat("Y-m-d H:i:s", $code->expires_at); // Corrected format
            if ($now->gt($endDate)) {
                return response()->json([
                    'status' => false,
                    'message' => "Coupon Code ($reqCode) - ($endDate) Has Been Expired. ($now)",
                    'code' => $reqCode,
                ]);
            }
        }

        // Overall Coupon Usage
        $couponUsed = Order::where('coupon_code_id', $code->id)->count();
        $maxUsage = $code->max_usage;
        if ($maxUsage > 0) {

            if ($couponUsed >= $maxUsage) {
                // dd("Coupon Code $code->code's Maximum Usage Limit $code->max_usage Exceeds : $couponUsed");
                return response([
                    'status' => false,
                    'message' => "Hey : ($user->name), This Coupon Code : ($reqCode)'s Maximum Usage Limit : ($maxUsage) Exceeds. It Can't Be Used.",
                ]);
            }
        }

        // Per User Coupon Usage
        $couponUsedUser = Order::where(['coupon_code_id' => $code->id, 'user_id' => $user->id])->count();
        $maxUsageUser = $code->max_usage_user;
        if ($maxUsageUser > 0) {

            if ($couponUsedUser >= $maxUsageUser) {
                return response([
                    'status' => false,
                    'message' => "Hey : ($user->name), You Can't Use Coupon Code : ($reqCode). Since It's Maximum Usage Per Limit : ($maxUsageUser) Exceeds.",
                ]);
            }
        }

        // Minimum Amount Dependant Coupon Code
        $subTotal = Cart::subtotal(2, '.', '');
        $minAmount = $code->min_amount;
        if ($minAmount > 0) {

            if ($subTotal < $minAmount) {
                return response([
                    'status' => false,
                    'message' => "Hey : ($user->name), Minimum Order Amount : ($minAmount) Is required To Avail This Coupon Code : ($reqCode).",
                ]);
            }
        }

        session()->put('code', $code);

        return $this->getOrderSummary($request);
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('code');
        return $this->getOrderSummary($request);
    }
}
