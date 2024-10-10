@include('front.layouts.head')


<header class="bg-white border-bottom">
    <div class="container">
        <nav class="navbar navbar-expand-xl navbar-light bg-white d-flex justify-content-between align-items-center"
            id="navbar">

            <!-- Brand Logo -->
            <div class="text-start">
                <a href="{{ route('front.home') }}" class="navbar-brand">
                    <img class="myntra_home" style="width: 75px;" src="{{ asset('front-assets/images/Myntra_logo.webp') }}"
                        alt="Myntra Home (Logo)" />
                </a>
            </div>

            <!-- Cart Header Details -->
            <div class="text-center d-none d-md-block cart-progress">
                <span class="step">BAG</span> <span class="divider">----------</span>
                <span class="step text-success">Address</span> <span class="divider">----------</span>
                <span class="step">Payment</span>
            </div>

            <!-- Cart Secure -->
            <div class="text-end">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <img class="cart-secure" src="{{ asset('front-assets/images/sprite-secure.png') }}"
                        style="width: 30px;" alt="Secure" />
                    <span class="ms-2">100% SECURE</span>
                </a>
            </div>

        </nav>
    </div>
</header>


<!-- Main Content -->
<div class="bg-white">
    <!-- Breadcrumb -->
    <section class="section-5 pt-3 pb-3 mb-3 mt-2 bg-white">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.shop') }}">Shop</a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.cart') }}">Cart</a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.checkout') }}">Checkout</a></li>
                <li class="breadcrumb-item">Payment</li>
            </ol>
        </div>
    </section>

    <!-- Cart and Summary Section -->
    <div class="row justify-content-center align-items-start">


        <div class="col-lg-10 col-md-9 cart-summary-section px-lg-5 px-md-3">
            <div class="row">
                @if (Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! Session::get('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif



                <div class="col-lg-8 col-md-12 col-sm-12 mb-4 " name="payments" id="payments">
                    <div class="card border shadow-sm p-3 bg-white">
                        <h4>Available Offers</h4>
                        <ul id="offerList">
                            <li>10% Instant Discount on ICICI Bank Credit and Debit Cards on a min spend of ₹3,500.
                                TCA</li>
                            <a id="showMoreOffers" class=" mt-2">Show More</a>
                            <div id="moreOffers" style="display:none;">

                                <li>10% Instant Discount on Kotak Credit and Debit Cards on a min spend of ₹3,500.
                                    TCA</li>
                                <li>10% Instant Discount on Kotak Credit and Debit Cards on a min spend of ₹3,500.
                                    TCA</li>
                                <li>10% Instant Discount on Kotak Credit and Debit Cards on a min spend of ₹3,500.
                                    TCA</li>
                                <li>10% Instant Discount on Kotak Credit and Debit Cards on a min spend of ₹3,500.
                                    TCA</li>

                                <a id="showLessOffers" class="mt-2">Show Less</a>
                            </div>
                        </ul>
                    </div>
                    <div class="card border shadow-sm p-3 bg-white mt-3">
                        <div class="choosePaymentMethod">
                            <div class="row">
                                <div class="col-4">Recommended</div>
                                <div class="col-8">Recommended Payment Options</div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="card bg-light">
                                        <span>Cash On Delivery (CASH / UPI)</span>
                                        <hr>
                                        <span>UPI (Pay Via Any App)</span>
                                        <hr>
                                        <span>Credit / Debit Card</span>
                                        <hr>
                                        <span>Pay Later</span>
                                        <hr>
                                        <span>Wallets</span>
                                        <hr>
                                        <span>EMI</span>
                                        <hr>
                                        <span>Net Banking</span>
                                    </div>
                                </div>
                                <div class="col-8">

                                    <form action="" method="post" id="paymentForm" name="paymentForm">
                                        <div class="form-group cod form-control mt-2">
                                            <div class="row align-items-center">
                                                <div class="col-1">
                                                    <input type="radio" class="payment_method"
                                                        name="payment_method" id="payment_method_cod" value="COD">
                                                </div>
                                                <div class="col-11">
                                                    <label for="payment_method_cod">Cash On Delivery (Cash/UPI)</label>
                                                </div>
                                            </div>
                                            <div class="cod-details mt-2 mb-2" id="cod-details"
                                                style="display:none;">
                                                <div class="form-group">
                                                    <input type="text"
                                                        placeholder="Enter code shown in above image*" id="cod-code"
                                                        class="form-control">
                                                </div>
                                                <span class="d-block">You can pay via Cash/UPI on delivery</span>
                                                <button type="submit" class="btn btn-danger mt-2 w-100">PLACE
                                                    ORDER</button>
                                            </div>
                                        </div>

                                        <div class="form-group upi form-control mt-3">
                                            <div class="row align-items-center">
                                                <div class="col-1">
                                                    <input type="radio" class="payment_method"
                                                        name="payment_method" id="payment_method_upi" value="UPI">
                                                </div>
                                                <div class="col-11">
                                                    <label for="payment_method_upi">PhonePe</label>
                                                </div>
                                            </div>
                                            <div class="upi-details mt-2 mb-2" id="upi-details"
                                                style="display:none;">
                                                <button type="submit" class="btn btn-danger mt-2 w-100">PAY
                                                    NOW</button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-8 col-sm-12 mb-4">
                    <div class="card border shadow-sm p-3">
                        <h6 class="card-title text-muted">PRICE DETAILS</h6>

                        <div class="price-details" id="disCountCouponBox">

                            @if (Session::has('code'))
                                <div id="cancelCouponBox"
                                    class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-4">
                                    <span class="mb-2 mb-sm-0">Cancel Coupon Code:</span>
                                    <a href="" id="cancelCoupon" class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            @endif


                            <div class="input-group apply-coupan mt-4 mb-4 pb-2" id="apply-coupon-code-box">
                                <input type="text" placeholder="Coupon Code" class="form-control"
                                    id="discount_code" name="discount_code"
                                    value="{{ Session::has('code') ? Session::get('code')->code : '' }}">
                                <button class="btn btn-outline-danger" type="button" id="apply-discount"
                                    name="apply-discount">Apply</button>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total MRP</span>
                                <?php
                                $subtotal = Cart::subtotal(); // Get the subtotal (as string with formatting)
                                $subtotalNumeric = floatval(str_replace(',', '', $subtotal)); // Remove commas and convert to float
                                ?>
                                <span>₹ {{ number_format($subtotalNumeric, 2) }}</span>
                            </div>

                            {{-- <div class="d-flex justify-content-between mb-2">
                                <span>Discount on MRP</span>
                                <span class="text-success">- ₹140</span>
                            </div> --}}

                            <div class="d-flex justify-content-between mb-2">
                                <span>Coupon Discount</span>
                                <span class="text-danger" id="couponDiscount">{{ $discount }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Platform Fee</span>
                                <span class="text-success">FREE</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping Fee</span>
                                <span class="text-success">FREE</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <strong>Total Amount</strong>

                                <strong class="grandTotal" id="grandTotal">₹
                                    {{ number_format($grandTotal, 2) }}
                                </strong>
                                {{-- <span>₹ {{ number_format($subtotalNumeric - 140, 2) }}</span> --}}
                            </div>

                            <div class="mt-3" id="payment-btn">
                                <a href="{{route('front.payment')}}">
                                    <button class="btn btn-danger w-100" id="continue-payment">CONTINUE</button>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JS : 03 - Toggle (Show) Offers
    document.getElementById('showMoreOffers').addEventListener('click', function() {
        document.getElementById('moreOffers').style.display = 'block';
        this.style.display = 'none';
    });

    // Toggle (Hide) Offers
    document.getElementById('showLessOffers').addEventListener('click', function() {
        document.getElementById('moreOffers').style.display = 'none';
        document.getElementById('showMoreOffers').style.display = 'block';
    });
</script>
@include('front.layouts.scripts')
