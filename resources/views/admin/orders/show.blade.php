@extends('admin.layouts.app')

@section('dyn-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order: #{{ $order->transaction_id }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="orders.html" class="btn btn-primary">Back</a>
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
                                    <address>
                                        <strong>Mohit Singh</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (804) 123-5432<br>
                                        Email: info@example.com
                                    </address>
                                </div>



                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                    <br>
                                    <b>Order ID:</b> 4F3S8J<br>
                                    <b>Total:</b> $90.40<br>
                                    <b>Status:</b> <span class="text-success">Delivered</span>
                                    <br>
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
                                        <td>Call of Duty</td>
                                        <td>$10.00</td>
                                        <td>2</td>
                                        <td>$20.00</td>
                                    </tr>
                                    <tr>
                                        <td>Call of Duty</td>
                                        <td>$10.00</td>
                                        <td>2</td>
                                        <td>$20.00</td>
                                    </tr>
                                    <tr>
                                        <td>Call of Duty</td>
                                        <td>$10.00</td>
                                        <td>2</td>
                                        <td>$20.00</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Subtotal:</th>
                                        <td>$80.00</td>
                                    </tr>

                                    <tr>
                                        <th colspan="3" class="text-right">Shipping:</th>
                                        <td>$5.00</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Grand Total:</th>
                                        <td>$85.00</td>
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
                                    <option value="">Pending</option>
                                    <option value="">Shipped</option>
                                    <option value="">Delivered</option>
                                    <option value="">Cancelled</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h4 mb-3">Send Inovice Email</h2>
                            <div class="mb-3">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Customer</option>
                                    <option value="">Admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

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
