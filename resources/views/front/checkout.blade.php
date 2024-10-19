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
                <li class="breadcrumb-item">Checkout</li>
            </ol>
        </div>

        <hr>

        <div class="container">
            @if (Session::has('success'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Cart and Summary Section -->
    <div class="row justify-content-center align-items-start">
        <div class="col-lg-1 col-md-3"></div>
        <div class="col-lg-10 col-md-9 cart-summary-section px-lg-5 px-md-3">
            @php
                $user = Auth::user(); // Get the authenticated user
                $userAddress = $user ? $user->customerAddresses()->exists() : false; // Check if the user has any saved addresses
            @endphp

            <div class="row" id="address">
                <div class="col-lg-7 col-md-8 col-sm-12 mb-4" id="notHaveAddress"
                    @if ($user && $userAddress) style="display:none;" @endif>
                    <div class="card border-1 p-3">

                        <form action="" method="POST" id="orderForm" name="orderForm">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label mb-2">CONTACT DETAILS</label>
                                <input type="text" name="name" id="name"
                                    class="form-control mb-2 @error('name') is-invalid @enderror" placeholder="Name*"
                                    value="{{ old('name') }}">
                                <div class="invalid-feedback" id="error-name"></div>

                                <input type="text" name="mobile_no" id="mobile_no"
                                    class="form-control mb-2 @error('mobile_no') is-invalid @enderror"
                                    placeholder="Mobile No*" value="{{ old('mobile_no') }}">
                                <div class="invalid-feedback" id="error-mobile_no"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="address" class="form-label mb-2">ADDRESS</label>
                                <input type="text" name="pincode" id="pincode"
                                    class="form-control mb-2 @error('pincode') is-invalid @enderror"
                                    placeholder="Pincode*" value="{{ old('pincode') }}">
                                <div class="invalid-feedback" id="error-pincode"></div>

                                <input type="text" name="address" id="address"
                                    class="form-control mb-2 @error('address') is-invalid @enderror"
                                    placeholder="Address*" value="{{ old('address') }}">
                                <div class="invalid-feedback" id="error-address"></div>

                                <input type="text" name="locality_town" id="locality_town"
                                    class="form-control mb-2 @error('locality_town') is-invalid @enderror"
                                    placeholder="Locality/Town*" value="{{ old('locality_town') }}">
                                <div class="invalid-feedback" id="error-locality_town"></div>

                                <input type="text" name="city" id="city"
                                    class="form-control mb-2 @error('city') is-invalid @enderror"
                                    placeholder="City/District*" value="{{ old('city') }}">
                                <div class="invalid-feedback" id="error-city"></div>

                                <input type="text" name="state" id="state"
                                    class="form-control mb-2 @error('state') is-invalid @enderror"
                                    placeholder="State*" value="{{ old('state') }}">
                                <div class="invalid-feedback" id="error-state"></div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="type" class="form-label mb-2">SAVE ADDRESS AS</label>
                                <div class="d-flex gap-2">
                                    <input type="radio" name="type" id="home" value="home"
                                        @if (old('type') == 'home') checked @endif> Home
                                    <input type="radio" name="type" id="work" value="work"
                                        @if (old('type') == 'work') checked @endif> Work
                                </div>

                            </div>

                            <div class="form-group mb-3">
                                <input type="hidden" name="default_address" value="0">
                                <input type="checkbox" name="default_address" id="default_address" value="1"
                                    @if (old('default_address')) checked @endif>
                                <label for="default_address" class="form-label">Mark this as my default
                                    address</label>

                            </div>

                            <button type="submit" class="btn btn-danger w-100">ADD ADDRESS</button>
                        </form>

                    </div>
                </div>

                <div class="col-lg-7 col-md-8 col-sm-12 mb-4 @if (!$user || !$userAddress) d-none @endif"
                    id="haveAddress">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0" id="deliverToText">Select Delivery Address</p>
                        <a href="#" class="btn btn-outline-secondary addNewAddress" id="addNewAddress">ADD NEW
                            ADDRESS</a>
                    </div>
                    <p>Default Address</p>


                    @foreach (getCustomerAddresses() as $custAdd)
                        <div class="card border-1 p-3">
                            <input type="radio" name="default_address" id="default_address_{{ $custAdd->id }}"
                                value="{{ $custAdd->id }}" @if ($custAdd->default_address ?? 0) checked @endif>
                            <label for="userName">{{ $custAdd->name ?? 'User Name' }}</label>
                            <span>{{ $custAdd->mobile_no ?? 'Mobile No.' }}</span>
                            <span>{{ $custAdd->address ?? 'Address' }}</span>
                            <span>{{ $custAdd->locality_town ?? 'Locality, Town' }}</span>
                            <span>{{ $custAdd->pincode ?? 'Pincode' }}</span>
                            <span>{{ $custAdd->city ?? 'City' }}</span>
                            <span>{{ $custAdd->state ?? 'State' }}</span>
                            <span>{{ $custAdd->type ?? 'Address Type' }}</span>
                            <span>Pay on Delivery available</span>

                            <div class="form-group mt-3">
                                <div class="d-flex gap-2">
                                    <form action="{{ route('address.destroy', $custAdd->id) }}" method="POST"
                                        class="remove-address-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-outline-secondary rounded-pill">Remove</button>
                                    </form>
                                    <div class="editButton">
                                        <button class="btn btn-outline-secondary rounded-pill editAddress"
                                            data-cust="{{ $custAdd }}" data-id="{{ $custAdd->id }}"
                                            data-name="{{ $custAdd->name }}"
                                            data-mobile_no="{{ $custAdd->mobile_no }}"
                                            data-pincode="{{ $custAdd->pincode }}"
                                            data-address="{{ $custAdd->address }}"
                                            data-locality_town="{{ $custAdd->locality_town }}"
                                            data-city="{{ $custAdd->city }}" data-state="{{ $custAdd->state }}"
                                            data-type="{{ $custAdd->type }}"
                                            data-default_address="{{ $custAdd->default_address }}">
                                            Edit </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Modal for Editing Address -->
                    <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog"
                        aria-labelledby="editAddressLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editAddressLabel">Edit Address</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button> --}}
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" id="editAddressForm">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="address_id" id="address_id">

                                        <div class="form-group mb-3">
                                            <label for="edit_name" class="form-label mb-2">CONTACT DETAILS</label>
                                            <input type="text" name="name" id="edit_name"
                                                class="form-control mb-2" placeholder="Name*" value="">
                                            <div class="invalid-feedback" id="error-name"></div>

                                            <input type="text" name="mobile_no" id="edit_mobile_no"
                                                class="form-control mb-2" placeholder="Mobile No*" value="">
                                            <div class="invalid-feedback" id="error-mobile_no"></div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="edit_address" class="form-label mb-2">ADDRESS</label>
                                            <input type="text" name="pincode" id="edit_pincode"
                                                class="form-control mb-2" placeholder="Pincode*" value="">
                                            <div class="invalid-feedback" id="error-pincode"></div>

                                            <input type="text" name="address" id="edit_address"
                                                class="form-control mb-2" placeholder="Address*" value="">
                                            <div class="invalid-feedback" id="error-address"></div>

                                            <input type="text" name="locality_town" id="edit_locality_town"
                                                class="form-control mb-2" placeholder="Locality/Town*"
                                                value="">
                                            <div class="invalid-feedback" id="error-locality_town"></div>

                                            <input type="text" name="city" id="edit_city"
                                                class="form-control mb-2" placeholder="City/District*"
                                                value="">
                                            <div class="invalid-feedback" id="error-city"></div>

                                            <input type="text" name="state" id="edit_state"
                                                class="form-control mb-2" placeholder="State*" value="">
                                            <div class="invalid-feedback" id="error-state"></div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="type" class="form-label mb-2">SAVE ADDRESS AS</label>
                                            <div class="d-flex gap-2">
                                                <input type="radio" name="type" id="edit_home" value="home">
                                                Home
                                                <input type="radio" name="type" id="edit_work" value="work">
                                                Work
                                            </div>
                                        </div>

                                        <!-- Default Address Checkbox -->
                                        <div class="form-group mb-3">
                                            <input type="hidden" name="default_address" value="0">
                                            <!-- Hidden default value (non-default) -->
                                            <input type="checkbox" name="default_address" id="edit_default_address"
                                                value="1">
                                            <label for="edit_default_address" class="form-label">Mark this as my
                                                default address</label>
                                        </div>

                                        <button type="submit" class="btn btn-danger w-100">Update Address</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mt-1 p-3">
                        <a href="#" class="text-danger addNewAddress" id="addNewAddress"> + Add New Address
                        </a>
                    </div>
                </div>

                <div class="col-lg-7 col-md-8 col-sm-12 mb-4 " name="payments" id="payments">
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


                            <div class="input-group apply-coupan mt-4 pb-2 " id="apply-coupon-code-box">
                                <input type="text" placeholder="Coupon Code" class="form-control"
                                    id="discount_code" name="discount_code"
                                    value="{{ Session::has('code') ? Session::get('code')->code : '' }}">
                                <button class="btn btn-outline-danger" type="button" id="apply-discount"
                                    name="apply-discount">Apply</button>
                            </div>

                            <div class="coupon-error-box mt-2 mb-3  laert alert-danger text-center"
                                id="coupon-error-box">

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
                                {{-- <a href="{{route('front.payment')}}">
                                    <button class="btn btn-danger w-100" id="continue-payment">CONTINUE</button>
                                </a> --}}
                                <button class="btn btn-danger w-100" id="continue-payment">CONTINUE</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    // 01 - Hideing Logic
    $("#payments").hide();
    $("#upi-details").hide();
    $("#cod-details").hide();

    // 01 - Show Hide Div's Based on Button Clicks
    $(document).ready(function() {
        // Toggle Between Payment Options
        $('input[name="payment_method"]').on('change', function() {
            if ($(this).val() === 'COD') {
                $("#cod-details").show();
                $("#upi-details").hide();
            } else if ($(this).val() === 'UPI') {
                $("#upi-details").show();
                $("#cod-details").hide();
            }
        });

        // Add New Address
        $('.addNewAddress').on('click', function(e) {
            e.preventDefault();
            $('#notHaveAddress').show();
            $('#haveAddress').hide();
            $('#payment-btn').hide();
            $('#apply-coupon-code-box').hide();
        });

        // Continue Payment
        $('#continue-payment').on('click', function(e) {
            e.preventDefault();
            $('#continue-payment').hide();
            $('#apply-coupon-code-box').hide();
            $('#haveAddress').hide();
            $("#payments").show();
        });
    });

    // 02 - Order Form Submission
    $("#orderForm").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the CSRF token
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '{{ route('front.processCheckout') }}',
            type: 'POST',
            data: $(this).serializeArray(),
            headers: {
                'X-CSRF-TOKEN': token
            },
            dataType: 'json',
            success: function(response) {
                // Clear any previous errors
                $(".form-control").removeClass("is-invalid");
                $(".invalid-feedback").html("");

                if (response.errors) {
                    // Handle individual field errors
                    if (response.errors.name) {
                        $("#name").addClass("is-invalid");
                        $("#error-name").html(response.errors.name[0]);
                    }
                    if (response.errors.mobile_no) {
                        $("#mobile_no").addClass("is-invalid");
                        $("#error-mobile_no").html(response.errors.mobile_no[0]);
                    }
                    if (response.errors.pincode) {
                        $("#pincode").addClass("is-invalid");
                        $("#error-pincode").html(response.errors.pincode[0]);
                    }
                    if (response.errors.address) {
                        $("#address").addClass("is-invalid");
                        $("#error-address").html(response.errors.address[0]);
                    }
                    if (response.errors.locality_town) {
                        $("#locality_town").addClass("is-invalid");
                        $("#error-locality_town").html(response.errors.locality_town[0]);
                    }
                    if (response.errors.city) {
                        $("#city").addClass("is-invalid");
                        $("#error-city").html(response.errors.city[0]);
                    }
                    if (response.errors.state) {
                        $("#state").addClass("is-invalid");
                        $("#error-state").html(response.errors.state[0]);
                    }
                } else {
                    // Successful form submission
                    alert("Address added successfully!");
                    location.reload();
                    // You can also redirect or perform other actions here
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });

    // 03 - Payment Form Submission
    $("#paymentForm").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        console.log(event);
        // $("button[type='submit']").prop("disabled", true);
        $.ajax({
            url: '{{ route('front.processPayment') }}',
            type: 'POST',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response) {
                $("button[type='submit']").prop("disabled", false);
                if (response.status == true) { // If status is true
                    alert(response.message); // Show a success message
                    window.location.href = "{{ route('front.thank', ':orderId') }}".replace(
                        ':orderId', response.orderId);
                    // Refresh the page after showing the message
                } else {
                    alert('There was an issue processing your order.');
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });

    // JS : 04- Apply Discount 
    $("#apply-discount").click(function() {
        console.log("You clicked Apply Coupon");
        $.ajax({
            url: '{{ route('front.applyDiscount') }}',
            type: 'post',
            data: {
                code: $('#discount_code').val()
            },
            dataType: 'json',
            success: function(response) {

                if (response.status == true) {
                    $("#couponDiscount").html('₹' + response.discount);
                    $("#grandTotal").html('₹' + response.grandTotal);

                    location.reload();
                } else {
                    $("#coupon-error-box").html(response.message);
                    // console.log("Response Message :: " + response.message + "\nResponse Staus :: " + response.status + "\nResponse Code :: " + response.code);
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX error: " + status + " - " + error);
            }
        });
    });

    // JS : 05 - Cancel Coupon Code
    $("#cancelCoupon").click(function() {
        $.ajax({
            url: '{{ route('front.removeCoupon') }}',
            type: 'post',
            dataType: 'json',
            success: function(response) {
                if (respone.status == true) {
                    // console.log("\n Response Status : " = response.status + "\n Response Message : " = response.message + "\n Response Code : " = response.code);
                    // $("#shippingAmount").html('$' + response.shippingCharge);
                    $("#cancelCoupon").hide();
                    $("#couponDiscount").html('₹' + response.discount);
                    $("#grandTotal").html('₹' + response.grandTotal);
                    $("#cancelCouponBox").hide();

                } else {
                    console.log("Response Message :: " + response.message + "\nResponse Staus :: " +
                        response.status + "\nResponse Code :: " + response.code);
                }
            },
            error: function(response) {
                console.error();
            }
        });
    });

    // JS : 06 - Showing Modal To Edit Address
    $(document).ready(function() {
        $('.editAddress').on('click', function() {
            // Get address data from the button's data attributes

            // const cust = $(this).data('cust');
            // console.log('cust', cust, 'cust AddID', cust.id);
            const addressId = $(this).data('id');
            const name = $(this).data('name');
            const mobileNo = $(this).data('mobile_no');
            const pincode = $(this).data('pincode');
            const address = $(this).data('address');
            const localityTown = $(this).data('locality_town');
            const city = $(this).data('city');
            const state = $(this).data('state');
            const type = $(this).data('type');
            const defaultAddress = $(this).data('default_address'); // Get the default address status

            // Set the data into the modal fields
            // $('#address_id').val(cust.id);
            $('#address_id').val(addressId);
            // console.log("addressId", addressId);
            $('#edit_name').val(name);
            $('#edit_mobile_no').val(mobileNo);
            $('#edit_pincode').val(pincode);
            $('#edit_address').val(address);
            $('#edit_locality_town').val(localityTown);
            $('#edit_city').val(city);
            $('#edit_state').val(state);

            // Set the radio button for the address type
            if (type === 'home') {
                $('#edit_home').prop('checked', true);
            } else {
                $('#edit_work').prop('checked', true);
            }

            // Set the checkbox for default address
            if (defaultAddress == 1) {
                $('#edit_default_address').prop('checked', true);
            } else {
                $('#edit_default_address').prop('checked', false);
            }


            // Show the modal
            $('#editAddressModal').modal('show');

            // Update the form action with the correct route
            $('#editAddressForm').attr('action', `/account/address/${addressId}`);
        });
    });
</script>

@include('front.layouts.scripts')
