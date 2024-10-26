@extends('admin.layouts.app')

@section('dyn-content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('orders.index')}}">Orders</a></li>
                    <li class="breadcrumb-item">List</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
             
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                        </div>

                        <div class="card-body pb-0">
                            <!-- Info -->
                            <div class="card card-sm">
                                <div class="card-body bg-light mb-3">
                                    <div class="row">
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Order No:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                {{$order->transaction_id}}
                                                <td>
                                                    @if ($item->product && $item->product->product_images->first())
                                                        <img src="{{ asset('uploads/Products/' . $item->product->product_images->first()->image) }}"
                                                            alt="{{ $item->product->product_images->first()->image }}"
                                                            class="" width="25" alt="Product Image" />
                                                    @else
                                                        <img src="{{ asset('uploads/Products/DummyImage.png') }}" class=""
                                                            width="25" alt="Dummy Product Image">
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $order->id ?? 'order id' }}</td> --}}
                                                <td>{{ $order->transaction_id ?? 'order transaction_id' }}</td>
                                                {{-- <td>{{ $item->name ?? 'item name' }}</td> --}}
                                                {{-- <td>{{ $order->name ?? 'order name' }}</td> --}}
                                                {{-- <td>{{ $order->mobile_no ?? 'order mobile_no' }}</td> --}}
                                                {{-- <td>{{ $order->user_email ?? 'order email' }}</td> --}}
                                                <td>{{ $item->price ?? 'item price' }}</td>
                                                <td>{{ $item->qty ?? 'item qty' }}</td>
                                                <td>{{ $item->total ?? 'item total' }}</td>
                                                {{-- <td>{{ $order->shipping ?? 'order shipping' }}</td> --}}
                                                {{-- <td>{{ $order->coupon_code ?? '-' }}</td> --}}
                                                <td>{{ $order->order_status ?? 'order order_status' }}</td>
                                                <td>{{ $order->payment_status ?? 'order payment_status' }}</td>
                                                {{-- <td>{{ $order->address ?? 'order address' }}</td>
                                                <td>{{ $order->locality_town ?? 'order locality_town' }}</td>
                                                <td>{{ $order->city ?? 'order city' }}</td>
                                                <td>{{ $order->pincode ?? 'order pincode' }}</td>
                                                <td>{{ $order->state ?? 'order state' }}</td> --}}
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/y') }}
                                                    {{-- <td>{{ \Carbon\Carbon::parse($item->created_at)->format('D, j M Y h:i:s A') }} --}}
                                                </td>
                                                <td>
                                                    <a href="{{ route('orders.edit', $item->id) }}">
    
                                                        <svg class="filament-link-icon w-4 h-4 mr-1"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path
                                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </td>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Shipped date:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                <time datetime="2019-10-01">
                                                    01 Oct, 2019
                                                </time>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Status:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                Awating Delivery
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                $259.00
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer p-3">

                            <!-- Heading -->
                            <h6 class="mb-7 h5 mt-4">Order Items (3)</h6>

                            <!-- Divider -->
                            <hr class="my-3">

                            <!-- List group -->
                            <ul>
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-4 col-md-3 col-xl-2">
                                            <!-- Image -->
                                            <a href="product.html"><img src="images/product-1.jpg" alt="..."
                                                    class="img-fluid"></a>
                                        </div>
                                        <div class="col">
                                            <!-- Title -->
                                            <p class="mb-4 fs-sm fw-bold">
                                                <a class="text-body" href="product.html">Cotton floral print Dress x 1</a>
                                                <br>
                                                <span class="text-muted">$40.00</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-4 col-md-3 col-xl-2">
                                            <!-- Image -->
                                            <a href="#"><img src="images/product-2.jpg" alt="..."
                                                    class="img-fluid"></a>
                                        </div>
                                        <div class="col">
                                            <!-- Title -->
                                            <p class="mb-4 fs-sm fw-bold">
                                                <a class="text-body" href="#">Suede cross body Bag x 1</a> <br>
                                                <span class="text-muted">$49.00</span>
                                            </p>
                                        </div>
                                    </div>
                                </li>

                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-4 col-md-3 col-xl-2">
                                            <!-- Image -->
                                            <a href="#"><img src="images/product-3.jpg" alt="..."
                                                    class="img-fluid"></a>

                                        </div>
                                        <div class="col">

                                            <!-- Title -->
                                            <p class="mb-4 fs-sm fw-bold">
                                                <a class="text-body" href="#">Sweatshirt with Pocket</a> <br>
                                                <span class="text-muted">$39.00</span>
                                            </p>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-lg mb-5 mt-3">
                        <div class="card-body">
                            <!-- Heading -->
                            <h6 class="mt-0 mb-3 h5">Order Total</h6>

                            <!-- List group -->
                            <ul>
                                <li class="list-group-item d-flex">
                                    <span>Subtotal</span>
                                    <span class="ms-auto">$128.00</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Tax</span>
                                    <span class="ms-auto">$0.00</span>
                                </li>
                                <li class="list-group-item d-flex">
                                    <span>Shipping</span>
                                    <span class="ms-auto">$8.00</span>
                                </li>
                                <li class="list-group-item d-flex fs-lg fw-bold">
                                    <span>Total</span>
                                    <span class="ms-auto">$136.00</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <h1>Order Details</h1>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Customer Name:</strong> {{ $order->name }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>
    <p><strong>Total:</strong> {{ $order->grand_total }}</p>

    <!-- Display Order Items with Product Details -->
    <h2>Order Items</h2>
    @foreach ($order->orderItems as $item)
        <div class="order-item">
            <p><strong>Product Name:</strong> {{ $item->product->name }}</p>
            <p><strong>Quantity:</strong> {{ $item->qty }}</p>
            <p><strong>Price:</strong> {{ $item->price }}</p>

            <!-- Product Image Section -->
            <h3>Product Images</h3>
            @if ($item->product && $item->product->product_images->first())
                <img src="{{ asset('uploads/Products/' . $item->product->product_images->first()->image) }}"
                    alt="{{ $item->product->product_images->first()->image }}" width="50" alt="Product Image" />
            @else
                <img src="{{ asset('uploads/Products/DummyImage.png') }}" width="50" alt="Dummy Product Image">
            @endif
        </div>
    @endforeach
@endsection


@section('customJs')
    <script>
        // Handle form submission via AJAX
        $("#orderForm").submit(function(event) {
            event.preventDefault();
            var element = $(this);
            $("button[type=submit]").prop('disabled', true);
            $.ajax({
                url: '{{ route('orders.update', $order->id) }}',
                type: 'PUT',
                data: element.serialize(),
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (response.status) {
                        window.location.href = "{{ route('orders.index') }}";
                        $("#title").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                        $("#name").removeClass('is-invalid').siblings('p').removeClass(
                            'invalid-feedback').html("");
                    } else {
                        var errors = response.errors;
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'],input[type='number'],select").removeClass('is-invalid');
                        $.each(errors, function(key, value) {
                            $(`#${key}`).addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(value);
                        });
                    }
                },
                error: function(jqXHR, exception) {
                    console.log("Something went wrong");
                }
            });
        });
    </script>
@endsection
