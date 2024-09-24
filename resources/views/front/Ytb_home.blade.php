 @extends('front.layouts.app')

 @section('content')

     {{-- First Image : Discount Coupons --}}
     <img src="{{ asset('front-assets/images/DiscountCoupon.jpg') }}" alt="Discount Coupon">
     {{-- Second Image : Hero Image --}}
     <img src="{{ asset('front-assets/images/heroImage.png') }}" alt="Hero Image">
     {{-- Third Image : Coupon Corner --}}
     <img src="{{ asset('front-assets/images/CouponCorner.jpg') }}" alt="Coupon Corner">
     {{-- Fourth Image : Coupons --}}
     <img src="{{ asset('front-assets/images/coupons.jpg') }}" alt="Coupons">

     <!-- Main Content (Featured Products) -->
     <section class="section-2">
         <div class="container">
             <div class="row justify-content-center g-0"> <!-- Removed space between columns with g-0 -->
                 @if ($featured_products->isNotEmpty())
                     @foreach ($featured_products as $product)
                         @php
                             $productImage = $product->product_images->first();
                         @endphp
                         <div class="col-md-6 col-lg-3 col-sm-6 col-12"> <!-- Removed mb-3 -->
                             <div class="card h-100">
                                 @if ($productImage && $productImage->image != '')
                                     <img src="{{ asset('uploads/Products/' . $productImage->image) }}"
                                         class="card-img-top cardImages"
                                         style="height: 300px; object-fit: cover; padding: 5px;"
                                         alt="Product Image {{ $product->id }}">
                                 @endif
                                 <div class="card-body">
                                     <h5 class="card-title">{{ $product->title }}</h5>
                                 </div>
                                 <ul class="list-group list-group-flush">
                                     <li class="list-group-item">{{ $product->title }}</li>
                                     <li class="list-group-item">{{ $product->price }}</li>
                                 </ul>
                             </div>
                         </div>
                     @endforeach
                 @else
                     <p class="text-center">Oops. No data found ... !!!</p>
                 @endif
             </div>
         </div>
     </section>



     {{-- Fifth Image : Crazy Deals --}}
     <img src="{{ asset('front-assets/images/CrazyDeals.jpg') }}" alt="Crazy Deals">

     {{-- Section : Section > Categories Showcase --}}
     <div id="sectionCategoriesCarousel" class="carousel slide" data-bs-ride="carousel">
         <div class="carousel-indicators">
             @foreach (getSections() as $key => $section)
                 <button type="button" data-bs-target="#sectionCategoriesCarousel" data-bs-slide-to="{{ $key }}"
                     class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                     aria-label="Section {{ $key + 1 }}"></button>
             @endforeach
         </div>

         <div class="carousel-inner">
             @foreach (getSections() as $key => $section)
                 <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                     <section class="section-3">
                         <div class="container mt-5">
                             @if ($section->categories->isNotEmpty())
                                 {{-- <h3>{{ $section->name }}</h3> --}}
                                 <div class="row pb-3">
                                     @foreach ($section->categories->sortByDesc('created_at')->take(4) as $category)
                                         <div class="col-lg-3">
                                             <div class="cat-card">
                                                 <div class="left">
                                                     @if ($category->image != '')
                                                         <img src="{{ asset('uploads/category/' . $category->image) }}"
                                                             alt="" class="img-fluid category-images"  style="height: 100px; object-fit: cover; padding: 5px;">
                                                     @endif
                                                 </div>
                                                 <div class="right">
                                                     <div class="cat-data">
                                                         <h2>{{ $category->name }}</h2>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     @endforeach
                                 </div>
                             @endif
                         </div>
                     </section>
                 </div>
             @endforeach
         </div>

         <button class="carousel-control-prev" type="button" data-bs-target="#sectionCategoriesCarousel"
             data-bs-slide="prev">
             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
             <span class="visually-hidden">Previous</span>
         </button>
         <button class="carousel-control-next" type="button" data-bs-target="#sectionCategoriesCarousel"
             data-bs-slide="next">
             <span class="carousel-control-next-icon" aria-hidden="true"></span>
             <span class="visually-hidden">Next</span>
         </button>
     </div>

     {{-- Sixth Image : Shop By Category Image --}}
     <img src="{{ asset('front-assets/images/myntra-shop-by-category.jpg') }}" alt="Shop By Category">

     {{-- Section : Category Showcase --}}
     <section class="section-3">
         <div class="container">
             <div class="section-title">
                 <h2>Categories</h2>
             </div>

             @if (!empty(getSubCategories()))
                 <div class="row pb-3">
                     @foreach (getSubCategories() as $subcategory)
                         <div class="col-lg-3">
                             <div class="cat-card">
                                 <div class="left">
                                     @if ($subcategory->image != '')
                                         <img src="{{ asset('uploads/subcategory/' . $subcategory->image) }}"
                                             alt="" class="img-fluid category-images"  style="height: 100px; object-fit: cover; padding: 5px;">
                                     @endif
                                 </div>
                                 <div class="right">
                                     <div class="cat-data">
                                         <h2>{{ $subcategory->name }}</h2>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     @endforeach
                 </div>
             @endif
         </div>
     </section>

 @endsection
