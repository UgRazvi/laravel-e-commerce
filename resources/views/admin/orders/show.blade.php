@extends('admin.layouts.app')

@section('dyn-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- @dd($order->transaction_id) --}}
                    <h1>Order: #{{ $order->id }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header pt-3">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <h1 class="h5 mb-3">Shipping Address</h1>
                                    <address style="line-height: 1.6; font-style: normal;">
                                        <strong>{{ $order->name }}</strong><br>
                                        {{ $order->address }}<br>
                                        {{ $order->locality_town }}
                                        {{ $order->city }} {{ $order->pincode }}<br>
                                        Phone: {{ $order->mobile_no }}<br>
                                        Email: {{ $order->user_email }}
                                    </address>

                                </div>

                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #{{ $order->transaction_id }}</b><br>
                                    <br>
                                    <b>Order ID:</b> #{{ $order->id }}<br>
                                    <b>Total:</b> ₹ {{ $order->grand_total }}<br>
                                    <b>Status:</b> <span class="text-success">{{ $order->order_status }}</span>
                                    <br>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    <div class="row row-cols-3 g-2">
                                        @foreach ($order->orderItems as $item)
                                            <div class="col">
                                                @if ($item->product && $item->product->product_images->first())
                                                    <img src="{{ asset('uploads/Products/' . $item->product->product_images->first()->image) }}"
                                                        alt="Product Image" class="img-fluid rounded" />
                                                @else
                                                    <img src="{{ asset('uploads/Products/DummyImage.png') }}"
                                                        alt="Dummy Product Image" class="img-fluid rounded" />
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body table-responsive p-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th width="100">Price</th>
                                        <th width="100">Qty</th>
                                        <th width="100">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td> {{ $item->name }} </td>
                                            <td> {{ $item->price }} </td>
                                            <td> {{ $item->qty }} </td>
                                            <td> {{ $item->total }} </td>
                                        </tr>
                                    @endforeach


                                    <tr>
                                        <th colspan="3" class="text-right">Subtotal:</th>
                                        <td>₹ {{ $order->subtotal }}</td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-right">Shipping:</th>
                                        <td>₹ {{ $order->shipping }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Discount:</th>
                                        <td>₹ {{ $order->discount }}</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Grand Total:</th>
                                        <td>₹ {{ $order->grand_total }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Order Status</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                        Shipped</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                </select>
                            </div>
                            <div class="mb-3 d-none ">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post" id="sendinvoiceEmail" name="sendinvoiceEmail">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Send Invoice Email</h2>
                                <div class="mb-3">
                                    <select name="userType" id="userType" class="form-control">
                                        <option value="customer">Customer</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection


@section('customJs')
    <script>
        // Handle form submission via AJAX
        $("#sendinvoiceEmail").submit(function(event) {
            event.preventDefault(); // Capital "D" in Default
            if (confirm("Are you sure to send INVOICE MAIL ?")) {
                $.ajax({
                    url: '{{ route('orders.sendInvoiceEmail', $order->transaction_id) }}',
                    type: 'post',
                    data: $(this).serializeArray(),
                    dataType: 'json',
                    success: function(response) {
                        window.location.href = '{{ route('orders.show', $order->id) }}';
                    }
                });
            }
        });
    </script>
@endsection
