@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mt-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                <li class="breadcrumb-item">{{ $product->title }}</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-7 pt-3 mb-3 bg-white">
   
    <link rel="stylesheet" href="{{asset('front-assets/css/product-page.css')}}">

    <div class="container my-5">
        <div class="row">
            @include('front.account.common.message')
            <!-- Product Images Section -->
            <div class="col-lg-7 col-md-12 mb-4">
                <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @if ($product->product_images != '')
                        @foreach ($product->product_images as $key => $productImage)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img class="w-100" src="{{ asset('uploads/Products/' . $productImage->image) }}"
                                alt="Product Image 1">
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <!-- Carousel Controls -->
                    <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>


            <!-- Product Details Section -->
            <div class="col-lg-5 col-md-12">
                <h1 class="product-title">{{ $product->title }}</h1>
                <p class="product-subtitle">{{ $product->slug }}</p>


                <!-- Rating and Reviews in a rectangle -->
                <div class="rating-box mb-2">
                    <span class="rating-value">4.1</span>
                    <div class="star-rating">
                        <i class="fas fa-star"></i> |
                    </div>

                    <span class="total-ratings">
                        299 Ratings</span>
                </div>
                <!-- Rating and Reviews -->


                <!-- Pricing Section -->
                <div class="pricing-section mb-3">
                    <h4 class="text-danger"> {{ $product->price }}
                        @if ($product->compare_price > 0)
                        <small class="text-decoration-line-through text-secondary">{{ $product->compare_price }}</small>
                        <span class="text-success">(55% OFF)</span>
                        @endif
                    </h4>
                    <p class="text-muted">Inclusive of all taxes</p>
                    {{-- Short Description : --}}
                    {!! $product->short_description !!}

                </div>

                <!-- Size Selection -->
                <div class="size-selection mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Select Size</h6>
                        <a href="#" class="text-primary">SIZE CHART ></a>
                    </div>

                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="size" id="sizeS" autocomplete="off">
                        <label class="size-circle" for="sizeS">S</label>

                        <input type="radio" class="btn-check" name="size" id="sizeM" autocomplete="off">
                        <label class="size-circle" for="sizeM">M</label>

                        <input type="radio" class="btn-check" name="size" id="sizeL" autocomplete="off">
                        <label class="size-circle" for="sizeL">L</label>

                        <input type="radio" class="btn-check" name="size" id="sizeXL" autocomplete="off">
                        <label class="size-circle" for="sizeXL">XL</label>

                        <input type="radio" class="btn-check" name="size" id="sizeXXL" autocomplete="off">
                        <label class="size-circle" for="sizeXXL">XXL</label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons mb-3 d-flex">
                    <a href="javascript:void(0);" onclick="addToCart({{ $product->id }})"
                        class="btn btn-pink w-100 mb-2 btn-add-to-bag me-2">
                        <div class="btn-content text-center">

                            <span class="big-text"> ADD TO BAG </span>
                            <span class="small-text">BUY WITH EARLY ACCESS</span>
                        </div>
                    </a>
                    <a href="javascript:void(0);" onclick="addToWishlist({{ $product->id }})"
                        class="btn btns-outline-secondary w-100 mb-2 pt-4 btn-wishlist">
                        <div class="btn-content text-center">
                            <span class="small-text">WISHLIST</span>
                        </div>
                    </a>

                    {{-- <a href="javascript:void(0);" onclick="addToWishlist()"
                        class="btn btns-outline-secondary w-100 mb-2 pt-4 btn-wishlist">
                        <div class="btn-content">
                            <span class="big-text">WISHLIST</span>
                        </div>
                    </a> --}}
                </div>

                <!-- Delivery Options -->
                <div class="delivery-options mb-3">
                    <h6>DELIVERY OPTIONS</h6>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter pincode">
                        <button class="btn btn-outline-secondary" type="button">Check</button>
                    </div>
                    <p class="text-muted mt-2">Please enter PIN code to check delivery time & Pay on Delivery
                        Availability</p>
                </div>

                <!-- Best Offers Section -->
                <div class="best-offers">
                    <h6>BEST OFFERS</h6>
                    <ul class="text-muted">
                        <li><strong>Best Price Rs: 458</strong></li>
                        <li>Applicable on: Orders above Rs. 300 (only on first purchase)</li>
                        <li>Coupon Code: <strong>40PERCNTOFF</strong></li>
                        <li>Coupon Discount: 40% off (Your total savings: Rs. 1241)</li>
                    </ul>
                    <h6>Additional Bank Offers</h6>
                    <ul class="text-muted">
                        <li>10% Discount on ICICI Credit Card, Debit Card & EMI transactions</li>
                        <li>10% Discount on Kotak Credit Card, Debit Card & EMI transactions</li>
                        <li>10% Discount on Axis Bank Credit Card EMI transactions</li>
                    </ul>
                </div>

                <!-- Product Details -->
                <h4 class="product-details-title mt-4">PRODUCT DETAILS</h4>
                <p>Navy Blue and Red striped T-shirt, has a polo collar, and long sleeves.</p>

                <!-- Size & Fit -->
                <h6 class="mt-4">Size & Fit</h6>
                <p>The model (height 6') is wearing a size M</p>

                <!-- Material & Care -->
                <h6 class="mt-4">Material & Care</h6>
                <p>Material: 100% Cotton<br>Machine Wash</p>

                <!-- Specifications -->
                <h6 class="mt-4">Specifications</h6>
                <div class="row">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><strong>Closure:</strong> Button</li>
                            <li><strong>Fit:</strong> Slim Fit</li>
                            <li><strong>Main Trend:</strong> New Basics</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li><strong>Occasion:</strong> Casual</li>
                            <li><strong>Pattern:</strong> Striped</li>
                            <li><strong>Sleeve Length:</strong> Long Sleeves</li>
                        </ul>
                    </div>
                </div>

                <!-- Ratings and Reviews -->
                <div class="ratings mt-5">
                    <h2>Ratings & Reviews</h2>
                    <div class="d-flex align-items-center mb-3">
                        <h2 class="me-3">4.2</h2>
                        <div class="d-flex text-warning me-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <span>1,433 Verified Buyers</span>
                    </div>

                    <!-- Rating Breakdown -->
                    <div class="rating-breakdown">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>5 Stars</span>
                            <div class="progress w-75">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 60%;"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span>60%</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>4 Stars</span>
                            <div class="progress w-75">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 30%;"
                                    aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span>30%</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>3 Stars</span>
                            <div class="progress w-75">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 7%;"
                                    aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span>7%</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>2 Stars</span>
                            <div class="progress w-75">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 2%;"
                                    aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span>2%</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>1 Star</span>
                            <div class="progress w-75">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 1%;"
                                    aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span>1%</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Photos -->
                <div class="customer-photos mt-5">
                    <h6>Customer Photos (12)</h6>
                    <div class="d-flex">
                        <img src="{{ asset('front-assets/images/cat-1.jpg') }}" alt="Customer 1" style="width: 100px;">
                        <img src="{{ asset('front-assets/images/cat-2.jpg') }}" alt="Customer 2" style="width: 100px;"
                            class="mx-2">
                        <img src="{{ asset('front-assets/images/cat-3.jpg') }}" alt="Customer 3" style="width: 100px;">
                        <img src="{{ asset('front-assets/images/cat-4.jpg') }}" alt="Customer 4" style="width: 100px;"
                            class="mx-2">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 mt-5">
        <div class="bg-light">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                        data-bs-target="#description" type="button" role="tab" aria-controls="description"
                        aria-selected="true">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping"
                        type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping &
                        Returns</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                        type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel"
                    aria-labelledby="description-tab">
                    <p>
                        {{-- {!! nl2br(e(strip_tags($product->description))) !!} --}}
                        {!! $product->description !!}
                    </p>
                </div>
                <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                    {!! $product->shipping_returns !!}
                </div>
                {{-- <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                </div> --}}
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="col-md-12">
                        <div class="row ">
                            <div class="col-md-6">
                                <form action="{{route('front.saveRatings', $product->id)}}" id="productratingForm"
                                    name="productratingForm" method="POST">
                                    @csrf
                                    <h3 class="h4 pb-3">Write a Review</h3>
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                        <p></p>
                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                        <p></p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="rating">Rating</label>
                                        <br>
                                        <div class="rating" style="width: 10rem">
                                            <input id="rating-5" type="radio" name="rating" value="5" /><label
                                                for="rating-5"><i class="fas fa-3x fa-star"></i></label>
                                            <input id="rating-4" type="radio" name="rating" value="4" /><label
                                                for="rating-4"><i class="fas fa-3x fa-star"></i></label>
                                            <input id="rating-3" type="radio" name="rating" value="3" /><label
                                                for="rating-3"><i class="fas fa-3x fa-star"></i></label>
                                            <input id="rating-2" type="radio" name="rating" value="2" /><label
                                                for="rating-2"><i class="fas fa-3x fa-star"></i></label>
                                            <input id="rating-1" type="radio" name="rating" value="1" /><label
                                                for="rating-1"><i class="fas fa-3x fa-star"></i></label>
                                        </div>
                                        <p class="product-rating-error"></p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">How was your overall experience?</label>
                                        <textarea name="comment" id="comment" class="form-control" cols="30" rows="10"
                                            placeholder="How was your overall experience?"></textarea>
                                        <p></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-dark">Submit</button>
                                    </div>

                                </form>
                            </div>

                            <div class="col-md-6 mt-5">
                                <div class="overall-rating mb-3">
                                    <div class="d-flex">
                                        <h1 class="h3 pe-3">{{ $product->product_ratings_avg_rating }}</h1>
                                        @php
                                            $avgPer = (($product->product_ratings_avg_rating*100)/5);
                                        @endphp
                                        {{-- @dd($avgPer, $product->product_ratings_avg_rating) --}}
                                        <div class="star-rating mt-2" title="">
                                            <div class="back-stars">
                                                
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                
                                                <div class="front-stars" style="width: {{$avgPer}}%">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pt-2 ps-2">({{ $product->product_ratings_count }} Reviews Total)</div>
                                    </div>
        
                                </div>
                                @if (!empty($product->product_ratings ))
                                    @foreach ($product->product_ratings as $rating)
                                        @php
                                            $ratingPer = (($rating->rating*100)/5);
                                        @endphp
                                        <div class="rating-group mb-4">
        
                                            <span> <strong> {{$rating->username}} With ({{$rating->email}}) - {{$rating->rating}} </strong></span>
                                           
                                            <div class="star-rating mt-2" title="">
                                                <div class="back-stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <div class="front-stars" style="width: {{$ratingPer}}%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="my-3">
                                                <p>
                                                    {{$rating->comment}}
                                                </p>
                                            </div>
                                        </div>
        
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
        </div>
    </div>

    {{-- </div> --}}

</section>

@if (!empty($relatedProducts))
<section class="pt-5 section-8">
    <div class="container">
        <div class="section-title">
            <h2>SIMILAR PRODUCTS</h2>
        </div>
        <div class="col-md-12">
            <div id="related-products" class="carousel">
                @foreach ($relatedProducts as $relatedProduct)
                @php
                $productImage = $relatedProduct->product_images->first();
                @endphp
                <div class="card product-card">

                    <div class="product-image position-relative">
                        <a href="{{ route('front.product', $relatedProduct->slug) }}" class="product-img">
                            @if ($productImage && $productImage->image != '')
                            <img src="{{ asset('uploads/Products/' . $productImage->image) }}"
                                class="card-img-top cardImages" style="height: 300px; object-fit: cover; padding: 5px;"
                                alt="Product Image {{ $product->id }}">
                            @endif
                        </a>


                        <!-- Rating Box -->
                        <div class="rating-box position-absolute bg-white p-2 rounded"
                            style="bottom: 25px; left: 10px; z-index:100;">
                            <span>4.0</span>
                            <i class="fa fa-star"></i>
                        </div>

                        <!-- Add To Cart Icon -->
                        <a class="wishlist position-absolute" href="javascript:void(0);"
                            onclick="addToCart({{ $relatedProduct->id }})" style="top: 10px; left: 10px; z-index: 100;">
                            <i class="fa fa-shopping-cart"></i>
                        </a>

                        <!-- Wishlist Icon -->
                        <a class="wishlist position-absolute" href="222" style="top: 10px; right: 10px; z-index: 100;">
                            <i class="far fa-heart"></i>
                        </a>
                    </div>

                    <div class="card-body text-center mt-3">

                        <!-- Product Name -->
                        <p class="product-item-title mb-2">{{ $relatedProduct->title }}</p>

                        <!-- Brand -->
                        <p class="product-item-brand mb-1"><strong>{!! $relatedProduct->description !!}</strong></p>

                        <!-- Pricing Section -->
                        <div class="product-item-pricing">

                            <!-- Current Price -->
                            <span class=" product-item-selling-price h5">
                                <strong> Rs. {{ $relatedProduct->price }} </strong>
                            </span>

                            <s class="product-item-mrp h6 text-muted">
                                <!-- Original Price (Compare price) -->
                                Rs. {{ $relatedProduct->compare_price }}
                            </s>

                            <!-- Discount -->
                            <span class="product-item-discount text-success">(60% OFF)</span>
                        </div>

                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@section('customJS')<script type="text/javascript">
    $("#productratingForm").submit(function(event){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('front.saveRatings', $product->id) }}",
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
                var errors = response.errors;

                if(response.status === 'false') {
                    // Handle errors for each field
                    if(errors.name){
                        $("#name").addClass('is-invalid').siblings("p").addClass("invalid-feedback").html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid').siblings("p").removeClass("invalid-feedback").html("");
                    }

                    if(errors.email){
                        $("#email").addClass('is-invalid').siblings("p").addClass("invalid-feedback").html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid').siblings("p").removeClass("invalid-feedback").html("");
                    }

                    if(errors.comment){
                        $("#comment").addClass('is-invalid').siblings("p").addClass("invalid-feedback").html(errors.comment);
                    } else {
                        $("#comment").removeClass('is-invalid').siblings("p").removeClass("invalid-feedback").html("");
                    }

                    if(errors.rating){
                        $(".product-rating-error").addClass('text-danger').html(errors.rating);
                    } else {
                        $(".product-rating-error").removeClass('text-danger').html("");
                    }
                } else {
                    // Redirect to product page upon successful rating submission
                    window.location.href = "{{ route('front.product', $product->slug) }}";
                }
            },
            error: function(xhr, status, error) {
                // Handle unexpected errors (like network issues)
                alert("Something went wrong. Please try again later.");
            }
        });
    });
</script>

@endsection