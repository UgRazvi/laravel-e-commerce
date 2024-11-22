

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
            <div class="card shadow-sm border-light">

                <form action="{{ route('orders.index') }}" method="GET" class="pt-3">
                    <div class="row d-flex align-items-center justify-content-center px-3">
                        <!-- Start Date -->
                        <div class="col-lg-4 mb-3">
                            <input type="date" id="start_date" name="start_date" class="form-control form-control-lg"
                                value="{{ request()->input('start_date') }}">
                        </div>
                
                        <!-- End Date -->
                        <div class="col-lg-4 mb-3">
                            <input type="date" id="end_date" name="end_date" class="form-control form-control-lg"
                                value="{{ request()->input('end_date') }}">
                        </div>
                
                        <!-- Filter Button -->
                        <div class="col-lg-4 mb-3">
                            <button type="submit" class="btn btn-dark btn-lg w-100">Filter</button>
                        </div>
                    </div>
                </form>
                
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped text-nowrap" id="table">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Txn. Id</th>
                                <th>Total</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
            
                            @if (!empty($orders))
                            @foreach ($orders as $order)
                            <tr class="text-center">
                                <td>{{ $order->id ?? 'N/A' }}</td>
                                <td>{{ $order->transaction_id ?? 'N/A' }}</td>
                                <td>{{ $order->subtotal ?? 'N/A' }}</td>
                                <td>{{ $order->order_status ?? 'N/A' }}</td>
                                <td>{{ $order->payment_status ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/y') }}</td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center">Oops. No data found ... !!! </td>
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
            // alert("Test 1");
            $('.table').DataTable({
                "order": [[0, 'DESC']], // Default ordering by first column
                "paging": true,  // Enable pagination
                "ordering": true, // Enable sorting
                "info": true,  // Show table information
                "searching": true, // Enable search functionality
                "lengthMenu": [10, 25, 50, 100, 500, 1000] // Page length options
            });
        });
    </script>

@endsection