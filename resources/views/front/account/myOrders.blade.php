@extends('front.account.profileLayout')

@section('profile-content')
    @php
        $user = Auth::user();
    @endphp

    <div class="wrapper container-fluid">
        <div class="styles-insiderBanner d-flex justify-content-between align-items-center p-2"
            style="letter-spacing: 1px; background-image: linear-gradient(to left, #f9daff, #dfefff);">
            <div class="p-1">
                <span><strong>MYNTRA INSIDER</strong></span> <br>
                <span>Earn 10 supercoins for every ₹ 100 purchase</span>
            </div>
            <div class="p-1">
                <a href="{{ route('account.myn-insider') }}">
                    <button class="btn btn-danger btn-sm">
                        <strong>Enroll Now</strong>
                    </button>
                </a>
            </div>
        </div>

        <div class="mt-3 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div>
                <span><strong>ALL ORDERS</strong></span> <br>
                <span>from anytime</span>
            </div>
            <div class="d-flex align-items-center mt-2 mt-md-0">
                <form id="filterSearchForm" class="d-flex">
                    <div class="input-group">
                        <span class="input-group-text" id="search-icon"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control" id="searchOrders"
                            placeholder="Search in orders" aria-label="Search" aria-describedby="search-icon">
                    </div>
                    <button type="button" class="btn btn-outline-dark ms-2" id="filter-icon" data-bs-toggle="modal"
                        data-bs-target="#filterModal">
                        <i class="fas fa-filter"></i>
                    </button>
                </form>
            </div>
        </div>

        <div id="ordersList" class="mt-4">
            @if ($myOrders->isEmpty())
                <div class="noOrdersFound text-center p-5">
                    <img src="{{ asset('front-assets/images/no-orders-found@3x.png') }}" alt="No Orders Found"
                        class="img-fluid w-50">
                    <p><strong>Sorry! No orders found</strong></p>
                    <p>Try using a different filter or search term.</p>
                </div>
            @else
                <div class="order-card bg-light p-1" id="orderCards">
                    @foreach ($myOrders as $order)
                        @foreach ($order->orderItems as $item)
                            <div class="card bg-white m-2 p-4 ">

                                <span class="text-capitalize">
                                    @if ($order->order_status == 'pending')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24" style="background: rgb(212, 213, 217); border-radius:50%;">
                                            <path fill="#282C3F" fill-rule="nonzero"
                                                d="M15.854 8.146a.495.495 0 0 0-.703 0L12 11.296l-3.15-3.15a.495.495 0 0 0-.704 0 .495.495 0 0 0 0 .703L11.297 12l-3.15 3.15a.5.5 0 1 0 .35.85.485.485 0 0 0 .349-.146l3.15-3.15 3.151 3.15a.5.5 0 0 0 .35.147.479.479 0 0 0 .35-.147.495.495 0 0 0 0-.703L12.702 12l3.15-3.15a.495.495 0 0 0 0-.704z">
                                            </path>
                                        </svg>
                                    @endif
                                    <strong> {{ $order->order_status ?? 'No Order Status' }} </strong>
                                </span>

                                <label><span>on</span> {{ \Carbon\Carbon::parse($item->created_at)->format('D, j M Y') }}
                                    <span>as per your order</span></label>
                                <div class="card bg-light px-2">
                                    <form action="#/#" method="post" id="orderItemForm" class="orderItemForm"
                                        name="orderItemForm">
                                        <div class="row d-flex align-items-center justify-content-center">
                                            <div class="col-2">
                                                @if ($item->product && $item->product->product_images->first())
                                                    <img src="{{ asset('uploads/Products/' . $item->product->product_images->first()->image) }}"
                                                        alt="{{ $item->product->product_images->first()->image }}"
                                                        class="img-fluid w-50 mt-3" />
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </div>
                                            <div class="col-10 mt-3">
                                                <span class="">
                                                    <strong>{{ $item->name ?? 'No Names Available' }}</strong>
                                                </span>
                                                <span class=""> {!! $item->product->short_description ?? 'No Description Available' !!} </span>
                                                <br>
                                                <span class=""> {{ $item->size ?? 'No Sizes Available' }} </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                    </div>
                        @endforeach
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filters</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="filterForm" action="{{ route('account.myOrders') }}" method="GET">
                        <!-- Status filter -->
                        <div class="mb-3">
                            <label for="orderStatus" class="form-label">Status</label>
                            <select class="form-select" id="orderStatus" name="order_status">
                                <option value="all" {{ request('order_status') == 'all' ? 'selected' : '' }}>All</option>
                                <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="shipped" {{ request('order_status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ request('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                        </div>
    
                        <!-- Time filter -->
                        <div class="mb-3">
                            <label for="orderTime" class="form-label">Time</label>
                            <select class="form-select" id="orderTime" name="time">
                                <option value="anytime" {{ request('time') == 'anytime' ? 'selected' : '' }}>Anytime</option>
                                <option value="30_days" {{ request('time') == '30_days' ? 'selected' : '' }}>Last 30 days</option>
                                <option value="6_months" {{ request('time') == '6_months' ? 'selected' : '' }}>Last 6 months</option>
                                <option value="1_year" {{ request('time') == '1_year' ? 'selected' : '' }}>Last 1 year</option>
                            </select>
                        </div>
    
                        <!-- Search filter -->
                        <div class="mb-3">
                            <label for="search" class="form-label">Search</label>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search by order ID or product name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="filterForm">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>
    

    <script></script>
@endsection
