<?php

// use App\Http\Controllers\ProfileController;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Route;
// use Intervention\Image\Image;
// use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MensProdController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\AdminLoginController;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\ProductController;
use Intervention\Image\Interfaces\ImageInterface;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\DiscountCodeController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\CustomerAddressController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\ProductSubCategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route For - Home Page
Route::get('/', [FrontController::class, 'index'])->name('front.home');

Route::get('/payment', [CartController::class, 'payment'])->name('front.payment');

Route::get('/test-razorpay', function () {
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    try {
        // Create a Razorpay order
        $razorpayOrder = $api->order->create([
            'amount' => 2000, // Amount in paisa (i.e., 10 INR)
            'currency' => 'INR',
            'payment_capture' => 1, // Auto capture
        ]);

        // Convert the Razorpay order object to an array or extract the necessary data
        $razorpayOrderData = [
            'id' => $razorpayOrder['id'],
            'amount' => $razorpayOrder['amount'],
            'currency' => $razorpayOrder['currency']
        ];

        // Return the Razorpay order data
        return [
            'razorpay_order_id' => $razorpayOrderData['id'],
            'amount' => $razorpayOrderData['amount'],
            'currency' => $razorpayOrderData['currency'],
        ];

    } catch (\Exception $e) {
        return $e->getMessage();
    }
});


Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
// Route::get('/clone-mens-prod', [MensProdController::class, 'index'])->name('front.prods.mensprod'); // Clone
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [ShopController::class, 'index'])->name('front.shop');
Route::get('/product/{slug}', [ShopController::class, 'product'])->name('front.product');
Route::get('/cart', [CartController::class, 'cart'])->name('front.cart');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('front.addToCart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('front.updateCart');
Route::post('/delete-item', [CartController::class, 'deleteItem'])->name('front.deleteItem.cart');
// Route::post('/delete-multiple-items.', [CartController::class, 'deleteMultipleItems'])->name('front.deleteMultipleItems.cart');
Route::post('/cart/delete-multiple-items', [CartController::class, 'deleteMultipleItems'])->name('front.deleteMultipleItems.cart');


Route::get('/thank/{orderId}', [CartController::class, 'thank'])->name('front.thank');

Route::post('/get-order-summary', [CartController::class, 'getOrderSummary'])->name('front.getOrderSummary');
Route::post('/apply-discount', [CartController::class, 'applyDiscount'])->name('front.applyDiscount');

Route::post('/remove-coupon', [CartController::class, 'removeCoupon'])->name('front.removeCoupon');

Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => "guest"], function () {
        Route::get('/register', [AuthController::class, 'register'])->name('account.register');
        Route::post('/process-register', [AuthController::class, 'processRegister'])->name('account.processRegister');

        Route::get('/login', [AuthController::class, 'login'])->name('account.login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');

    });
    Route::group(['middleware' => "auth"], function () {
        // Route::get('/profile', [AuthController::class, 'profile'])->name("account.profile");
        Route::get('/logout', [AuthController::class, 'logout'])->name('account.logout');

        Route::post('/process-checkout', [CartController::class, 'processCheckout'])->name('front.processCheckout');
        Route::post('/process-payment', [CartController::class, 'processPayment'])->name('front.processPayment');

        Route::put('/address/{id}', [CustomerAddressController::class, 'update'])->name('address.update');
        Route::delete('/address/{id}', [CustomerAddressController::class, 'destroy'])->name('address.destroy');

        Route::get('/my-orders', [AuthController::class, 'myOrders'])->name("account.myOrders"); // (To work on 15 October 2024).
        Route::get('/orders/filter', [AuthController::class, 'filter'])->name('orders.filter');
        Route::get('/item-details', [AuthController::class, 'filter'])->name('order.itemDetails');

        Route::get('/dashboard', [UserProfileController::class, 'userDashboard'])->name("account.myDashboard");

        Route::get('/profile', [AuthController::class, 'profile'])->name("account.profile");
        Route::get('/profile/edit/', [AuthController::class, 'profileEdit'])->name("account.profileEdit");
        Route::put('/profile/update/', [AuthController::class, 'profileUpdate'])->name("account.profileUpdate");
        Route::post("/delete-account-suggestion", [AuthController::class, "deleteAccountSuggestion"])->name("account.deleteAccountSuggestion");

        Route::get("/delete-account", [UserProfileController::class, "deleteAccount"])->name("account.deleteAccount");
        Route::get("/myn-insider", [UserProfileController::class, "mynInsider"])->name("account.myn-insider");
        Route::get("/myn-cash", [UserProfileController::class, "mynCash"])->name("account.mynCash");
        Route::get("/myn-credit", [UserProfileController::class, "mynCredit"])->name("account.mynCredit");

        Route::get("/myn-coupon", [DiscountCodeController::class, "mynCoupon"])->name("account.mynCoupon");
        Route::get('/get-products-by-category', [DiscountCodeController::class, 'getProductsByCategory'])->name("account.getCatProd");

        // Route to handle storing a new address
        Route::post('/account/address', [CustomerAddressController::class, 'store'])->name('address.store');
        Route::get("/my-address", [CustomerAddressController::class, "viewUserAddress"])->name("account.myAddress");

        Route::get("/terms-conditions", [UserProfileController::class, 'termsCondition'])->name("account.terms");
        Route::get("/privacy-policy", [UserProfileController::class, 'privacyPolicy'])->name("account.policy");

    });
});

Route::get('/mens-prod', [MensProdController::class, 'index'])->name('front.mensprod');
Route::view('contactus', 'contactus');

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['admin.guest']], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => ['admin.auth']], function () {

        Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
        Route::delete('/product-images/', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        // Products Routes
        Route::get('/get-products', [ProductController::class, 'getProducts'])->name('products.getProducts');
        // To Save Product Images Permanently.
        Route::resource('/products', ProductController::class);

        // Coupons Route.
        Route::resource('/coupon', DiscountCodeController::class);

        // Products Sub Category Routes
        Route::resource('/product-subcategories', ProductSubCategoryController::class);
        Route::resource('/product-categories', ProductCategoryController::class);

        //Sections
        Route::resource('/sections', SectionController::class);

        // Route::get('/products', [ProductController::class, 'index'])->name('products.index');

        // Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        // Route::post('/products', [ProductController::class, 'store'])->name('products.store');


        // Route::get('/products/{product}/edit/', [ProductController::class, 'edit'])->name('products.edit');
        // Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

        // Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');


        // Brands Routes
        Route::get('/brands', [BrandsController::class, 'index'])->name('brands.index');

        Route::get('/brands/create', [BrandsController::class, 'create'])->name('brands.create');
        Route::post('/brands', [BrandsController::class, 'store'])->name('brands.store');


        Route::get('/brands/{brand}/edit/', [BrandsController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [BrandsController::class, 'update'])->name('brands.update');

        Route::delete('/brands/{brand}', [BrandsController::class, 'destroy'])->name('brands.delete');

        // Sub Category Routes
        Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');

        Route::get('/subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
        Route::post('/subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');

        Route::get('/subcategories/{category}/edit/', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
        Route::put('/subcategories/{category}', [SubCategoryController::class, 'update'])->name('subcategories.update');

        Route::delete('/subcategories/{category}', [SubCategoryController::class, 'destroy'])->name('subcategories.delete');

        // Category Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

        Route::get('/categories/{category}/edit/', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');


        // Image Route
        Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp-images.create');

        // Slug Route
        Route::get('/getSlug', function (Request $request) {
            $slug = '';
            if (!empty($request->title)) {
                $slug = Str::slug($request->title);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('get.slug');
    });
});
