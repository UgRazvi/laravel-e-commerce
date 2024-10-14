@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user();
    @endphp

    <div class="container">
        <div class="filters-section">

            <label for="sort_by">Sort By:</label>
            <a href="{{ route('account.mynCoupon', ['sort' => 'trending']) }}"
                class="btn btn-rounded-pill btn-clrfl" style="">Trending</a>
            <a href="{{ route('account.mynCoupon', ['sort' => 'discount']) }}"
                class="btn btn-rounded-pill btn-clrfl">Discount</a>
            <a href="{{ route('account.mynCoupon', ['sort' => 'expiring_soon']) }}"
                class="btn btn-rounded-pill btn-clrfl">Expiring
                Soon</a>
            <a href="{{ route('account.mynCoupon', ['sort' => 'all']) }}" class="btn btn-rounded-pill btn-clrfl">All</a>

            <hr>

        </div>

        <div class="row justify-content-between mt-4">
            @foreach ($coupons as $coupon)
                <div class="p-3 bg-white border rounded d-flex col-md-12 col-sm-12 my-2" style="width: 49%">
                    <div class="d-flex align-items-center pr-3">
                        @if ($coupon->categories->isNotEmpty())
                            <img src="{{ asset('uploads/category/' . $coupon->categories->first()->image) }}"
                                alt="{{ $coupon->categories->first()->name }} Image" class="img-fluid w-100">
                        @else
                            <img src="https://assets.myntassets.com/assets/images/retaillabs/2023/2/7/bd57362e-9e8c-4af1-b7e0-1b6df92400c51675765230597-UNISEX-LOUNGEWEAR-AND-SOCKS.jpg"
                                alt="Default Coupon Image" class="img-fluid w-100">
                        @endif
                    </div>

                    <div class="position-relative">
                        <div class="border-left border-dashed h-100 d-none d-lg-block" style="border-width: 1px;"></div>
                        <img src="{{ asset('front-assets/images/scissor.svg') }}" alt="Scissor icon"
                            class="position-absolute scissor-icon d-none d-lg-block ">
                    </div>

                    <div class="d-flex flex-column justify-content-between px-4 w-100">
                        <div>
                            @if ($coupon->type == 'fixed')
                                <h5 class="font-weight-bold mb-4"><strong>Flat ₹{{ $coupon->discount_amount }} off</strong>
                                </h5>
                            @else
                                <h5 class="font-weight-bold mb-4"><strong>Flat {{ $coupon->discount_amount }}% off</strong>
                                </h5>
                            @endif

                            <p class="text-muted small mb-1">Code: {{ $coupon->code }}</p>
                            <p class="small mb-0">Expiry: <strong class="text-dark">15 Oct 2024</strong></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <a href="#" class="d-flex align-items-center view-products"
                                data-coupon-code="{{ $coupon->code }}"
                                data-coupon-description="{{ $coupon->description }}"
                                data-discount-amount="{{ $coupon->discount_amount }}" data-type="{{ $coupon->type }}"
                                data-minimum-order="{{ $coupon->min_amount }}">
                                <strong class="mt-3 text-danger"> View Products &nbsp; &nbsp; &nbsp; ❯ </strong>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bootstrap Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Products Related to Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modalCouponDetails">
                            <h6 id="couponCode" class="d-none"></h6>
                            <p id="couponDescription" class="d-none"></p>
                            <p id="discountAmount" class="d-none"></p>
                            <p id="minimumOrderAmount"></p>

                            {{-- Usman - Hide Temporarily  --}}
                            <h6 class="d-none">Product Categories:</h6>
                            {{-- Usman - Hide Temporarily  --}}
                            <div id="categoryList" class="row mb-3 d-none"></div>
                        </div>
                        <h6>Related Products:</h6>

                        <div id="productList" class="row"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.view-products', function() {
            // Get data attributes from the clicked button
            const couponCode = $(this).data('coupon-code');
            const couponDescription = $(this).data('coupon-description');
            const discountAmount = $(this).data('discount-amount');
            const couponType = $(this).data('type');
            const minimumOrder = $(this).data('minimum-order');

            // Set modal content
            $('#couponCode').text(`Coupon Code: ${couponCode}`);
            $('#couponDescription').text(`Description: ${couponDescription}`);
            $('#discountAmount').text(
                `Discount: ${couponType === 'fixed' ? `Flat ₹${discountAmount}` : `Flat ${discountAmount}%`}`);
            $('#minimumOrderAmount').text(`Minimum Order Amount: ₹${minimumOrder}`);

            // Clear previous products and categories
            $('#productList').empty();
            $('#categoryList').empty();

            $.ajax({
                url: "{{ route('account.getCatProd') }}",
                type: 'GET',
                data: {
                    couponCode: couponCode
                },
                // beforeSend: function() {
                //     $('#productList').html(
                //         '<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading products...</div>'
                //     );
                // },
                success: function(response) {
                    // ... (populate modal as before)
                    console.log("Populating Modal");
                    // Populate coupon details
                    const {
                        coupon,
                        products,
                        categories
                    } = response;

                    // Update modal coupon details
                    $('#couponCode').text(`Coupon Code: ${coupon.code}`);
                    $('#couponDescription').text(`Description: ${coupon.description}`);
                    $('#discountAmount').text(
                        `Discount: ${coupon.type === 'fixed' ? `Flat ₹${coupon.discount_amount}` : `Flat ${coupon.discount_amount}%`}`
                    );
                    $('#minimumOrderAmount').text(`Minimum Order Amount: ₹${coupon.min_amount}`);


                    categories.forEach(category => {
                        // Assuming category images are stored in /uploads/category/
                        let categoryImage = category.image ?
                            `/uploads/category/${category.image}` : 'path/to/default-image.jpg';

                        $('#categoryList').append(`
                            <div class="col-md-4 category-info mb-3">
                                <a href="/shop/${category.slug}">
                                    <h6>${category.name}</h6>
                                    <img src="${categoryImage}" alt="${category.name}" class="img-fluid" style="max-width: 100px;">
                                </a>
                            </div>
                        `);

                    });

                    // Show products
                    products.forEach(product => {
                        // Assuming each product has a 'product_images' relationship
                        let productImage = product.product_images.length > 0 ? product
                            .product_images[0].image : 'default.jpg';

                        $('#productList').append(`
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <img src="/uploads/Products/${productImage}" class="card-img-top" alt="${product.title}" style="height: 300px; object-fit: cover; padding: 5px;">
                                    <div class="card-body">
                                        <h5 class="card-title">${product.title}</h5>
                                        <p class="card-text">${product.description}</p>
                                        <p class="card-text"><strong>Price: ₹${product.price}</strong></p>
                                            <a href="/product/${product.slug}" class="btn btn-danger">View Product</a>
                                    </div>
                                </div>
                            </div>
                        `);
                    });

                },
                error: function(xhr) {
                    const errorMessage = xhr.status === 404 ?
                        'No products found for this coupon.' :
                        'An error occurred. Please try again later.';
                    $('#productList').html(`<p class="text-danger">${errorMessage}</p>`);
                }
            });


            // Show the modal
            $('#productModal').modal('show');
        });
    </script>

    <style>
        .border-dashed {
            margin-left: 20px !important;
            border-style: dashed !important;
            border-color: grey;
        }

        .scissor-icon {
            top: 0%;
            left: 9px;
            width: 24px;
            height: 24px;
        }

        @media (max-width: 768px) {
            .coupon-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .scissor-icon {
                left: 15px;
                top: 5px;
            }
        }
    </style>
@endsection
