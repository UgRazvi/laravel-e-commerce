@extends('admin.layouts.app')
@section('dyn-content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>orders</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            @include('admin.message')
            <div class="card">

                <div class="card-body table-responsive p-2">

                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>Image</th>
                                {{-- <th>ID</th> --}}
                                <th>Txn. Id</th>
                                {{-- <th>Item Name</th> --}}
                                {{-- <th>User Name</th> --}}
                                {{-- <th>Mob. No</th> --}}
                                {{-- <th>E-mail</th> --}}
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                {{-- <th>Shipping</th> --}}
                                {{-- <th>Coupon</th> --}}
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                {{-- <th>Address</th>
                                <th>Locality</th>
                                <th>City</th>
                                <th>Pin Code</th>
                                <th>State</th> --}}
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (!empty($orders))
                                @foreach ($orders as $order)
                                    @foreach ($order->orderItems as $item)
                                        <tr class="text-center">
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
                                                <a href="{{ route('orders.show', $item->id) }}">

                                                    <svg class="filament-link-icon w-4 h-4 mr-1"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @else
                                <tr>
                                    <td>Oops. No data found ... !!! </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </section>
@endsection
@section('customJs')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "paging": true, // Enable pagination
                "ordering": true, // Enable sorting
                "info": true, // Show table info
                "searching": true, // Enable search
                "lengthMenu": [5, 10, 25, 50, 100, 500, 1000] // Page length options
            });
        });
    </script>
@endsection
