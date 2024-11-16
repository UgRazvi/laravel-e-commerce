@extends('admin.layouts.app')

@section('dyn-content')

{{-- @dd($rating); --}}
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- @dd("Product - Product_Images",$product->product_images->first()->image) --}}
                <h1> {{ $product->title }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('rating.index') }}" class="btn btn-primary">Back</a>
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
            <!-- Left Section: Rating Information -->
            <div class="col-md-8 mb-4">
                <div class="card border-light shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('uploads/Products/' . $product->product_images->first()->image) }}"
                                    alt="User Image">
                            </div>

                            <div class="col-md-7">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>User Name:</strong> {{ $rating->username }}</li>
                                    <li class="mb-2"><strong>Email:</strong> {{ $rating->email }}</li>
                                    <li class="mb-2"><strong>Comment:</strong> {{ $rating->comment }}</li>
                                    <li class="mb-2">
                                        <strong>Status:</strong>
                                        <span class="badge {{ $rating->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $rating->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </li>
                                    <li class="mb-2"><strong>Ratings:</strong> <span class="h4">{{ $rating->rating
                                            }}</span> / 5</li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Section: Update Status -->
            <div class="col-md-4 mb-4">
                <form action="{{ route('rating.updateStatus', $rating->id) }}" method="POST" id="updateRatingStatus"
                    name="updateRatingStatus">
                    @csrf
                    @method('POST')
                    <!-- Using POST for updating -->
                    <div class="card border-light shadow-sm rounded-3">
                        <div class="card-body">
                            <h4 class="card-title text-primary">Approve Rating</h4>
                            <div class="mb-4 mt-5">
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ $rating->status == 1 ? 'selected' : '' }}>Approve</option>
                                    <option value="0" {{ $rating->status == 0 ? 'selected' : '' }}>Unapprove</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update</button>
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

{{-- @section('customJs')
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
        // $("#PaymentStatusForm").submit(function(event) {
        //     event.preventDefault(); // Capital "D" in Default
        //     if (confirm("Are you sure to Update Payment Status ?")) {
        //         $.ajax({
        //             url: '{{ route('orders.updatePaymentStatus', $order->transaction_id) }}',
        //             type: 'post',
        //             data: $(this).serializeArray(),
        //             dataType: 'json',
        //             success: function(response) {
        //                 window.location.href = '{{ route('orders.show', $order->id) }}';
        //             }
        //         });
        //     }
        // });
</script>
@endsection --}}