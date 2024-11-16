@extends('admin.layouts.app')
@section('dyn-content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Ratings</h1>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">

            <div class="card-body table-responsive p-2">

                <table class="table table-hover text-nowrap" id="table">
                    <thead>
                        <tr class="text-center">
                            {{-- <th>Image</th> --}}
                            <th>ID</th>
                            <th>Product</th>
                            <th>User Name</th>
                            <th>E-mail</th>
                            <th>Commment</th>
                            <th>Status</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        
                        @if (!empty($ratings))
                        @foreach ($ratings as $rating)
                        <tr class="text-center">
                            
                            {{-- @dd($rating->product->title) --}}
                            <td>{{ $rating->id ?? 'Rating ID' }}</td>
                            <td>{{ $rating->product->title ?? 'Product Name' }}</td>
                            <td>{{ $rating->username ?? 'Username' }}</td>
                            <td>{{ $rating->email ?? 'Email' }}</td>
                            <td>{{ $rating->comment ?? 'Comment' }}</td>
                            <td>{{ $rating->status==1 ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $rating->rating ?? 'No Rating' }}</td>
                            
                
                            {{-- <td>{{ \Carbon\Carbon::parse($rating->created_at)->format('d/m/y') }} --}}
                                
                            {{-- {{ \Carbon\Carbon::parse($rating->created_at)->format('D, j M Y h:i:s A') }}  --}}
                            </td>
                            <td>
                                <a href="{{ route('rating.edit', $rating->id) }}">

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