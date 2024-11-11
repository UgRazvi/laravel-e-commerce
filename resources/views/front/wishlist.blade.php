@include('front.layouts.head')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a>
                    </li>
                    <li class="breadcrumb-item">Wishlist</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-12">
        <div class="container  mt-5">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                        </div>
                        <div class="card-body p-4">
                            {{-- @dd($wishlists); --}}
                            @foreach ($wishlists as $item)
                                @php
                                    $productImage = getProductImage($item->product_id);
                                @endphp
                                {{-- @dd($item, $item->product, $item->product->image); --}}
                                <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                    <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a
                                            class="d-block flex-shrink-0 mx-auto me-sm-4" href="#"
                                            style="width: 10rem;">


                                            @if (!empty($productImage))
                                                <!-- Ensure product and image exist -->
                                                <img src="{{ asset('uploads/Products/' . $productImage->image) }}"
                                                    alt="{{ $item->product->name }}">
                                            @else
                                                <p>No image available</p>
                                            @endif
                                        </a>

                                        <div class="pt-2">
                                            <h3 class="product-title fs-base mb-2"><a
                                                    href="shop-single-v1.html">{{ $item->product->title }}</a></h3>
                                            <div class="fs-lg text-accent pt-2">{{ $item->product->price }}</div>
                                        </div>
                                    </div>
                                    <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                        <button class="btn btn-outline-danger btn-sm" type="button"
                                            onclick="removeProduct({{ $item->product_id }})">
                                            <i class="fas fa-trash-alt me-2"></i>Remove
                                        </button>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('front.layouts.scripts')

