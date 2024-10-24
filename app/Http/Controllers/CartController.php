<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\PayUService;
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
    private $payUService;

    public function __construct(ProcessPaymentService $processPaymentService, PayUService $payUService)
    {
        $this->processPaymentService = $processPaymentService;
        $this->payUService = $payUService;
    }

    public function processPayment(Request $request)
    {
        if ($request->payment_method == 'COD') {
            return $this->processPaymentService->processPaymentCOD($request);
        }
    }
    public function payU(Request $request)
    {
        if ($request->payment_method == 'PayU') {
            return $this->payUService->pay($request);
        }
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
       
    }


    public function thank($txnId)
    {
        // dd($id);
        return view("front.thank", compact("txnId"));
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

        // $user = Auth::user();

        $MERCHANT_KEY = env('PAYU_MERCHANT_KEY');
        $SALT = env('PAYU_MERCHANT_SALT');


        $PAYU_BASE_URL = "https://test.payu.in";

        //$PAYU_BASE_URL = "https://secure.payu.in"; // PRODUCATION
        $name = $user->name;
        $successURL = route('pay.u.response');
        $failURL = route('pay.u.cancel');
        $email = $user->email;
        $phone = $user->mobile_no;
        $amount = (int) $grandTotal;

        $action = '';
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $posted = array();
        $posted = array(
            'key' => $MERCHANT_KEY,
            'txnid' => $txnid,
            'amount' => $amount,
            'firstname' => $name,
            'email' => $email,
            'phone' => $phone,
            'productinfo' => 'Webappfix',
            'surl' => $successURL,
            'furl' => $failURL,
            'service_provider' => 'payu_paisa',
        );

        if (empty($posted['txnid'])) {
            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        } else {
            $txnid = $posted['txnid'];
        }

        $hash = '';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

        if (empty($posted['hash']) && sizeof($posted) > 0) {
            $hashVarsSeq = explode('|', $hashSequence);
            $hash_string = '';
            foreach ($hashVarsSeq as $hash_var) {
                $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                $hash_string .= '|';
            }
            $hash_string .= $SALT;

            $hash = strtolower(hash('sha512', $hash_string));
            $action = $PAYU_BASE_URL . '/_payment';
        } elseif (!empty($posted['hash'])) {
            $hash = $posted['hash'];
            $action = $PAYU_BASE_URL . '/_payment';
        }

        return view("front.checkout", compact("customerAddress", "discount", "grandTotal",'action', 'hash', 'MERCHANT_KEY', 'txnid', 'successURL', 'failURL', 'name', 'email', 'amount'));

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
