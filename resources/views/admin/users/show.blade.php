@extends('admin.layouts.app')
@section('dyn-content')

<style>
    /* User profile page styling */
    .user-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 50%;
        width: 180px;
        height: 180px;
        margin: 0 auto;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .user-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.3s ease-in-out;
    }

    .user-image-container:hover .user-image {
        transform: scale(1.1);
        /* Zoom effect */
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-in-out;
    }

    .card-header {
        background-color: #007bff;
        border-radius: 15px 15px 0 0;
        padding: 15px;
        font-size: 1.25rem;
    }

    .card-header a {
        font-size: 0.9rem;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 20px;
        transition: background-color 0.3s ease;
    }

    .card-header a:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .card-body {
        padding: 20px;
    }

    .user-details p {
        font-size: 1.1rem;
        margin: 10px 0;
        color: #555;
    }

    .user-details strong {
        color: #333;
    }

    .text-dark {
        color: #333 !important;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.5rem;
        border-radius: 5px;
        text-transform: uppercase;
        font-weight: bold;
    }

    .badge.bg-success {
        background-color: #28a745;
    }

    .badge.bg-danger {
        background-color: #dc3545;
    }

    /* Button Styles */
    .btn {
        border-radius: 20px;
        padding: 10px 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
        color: #fff;
        /* Ensure text color changes */
        background-color: #007bff;
        /* Change background color on hover */
        transform: translateY(-5px);
        /* Lift the button slightly */
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.2);
        /* Soft blue shadow for modern look */
        transition: all 0.3s ease;
        /* Smooth transition for all properties */
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<section class="content mt-4">
    <div class="container-fluid">
        <!-- User Details Card -->
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-dark text-white d-flex justify-content-center align-items-center">
                <h2 class="m-0">
                    <span>User Profile</span>
                    <a href="{{ route('users.index') }}" class="btn btn-light text-dark">
                        <i class="fas fa-arrow-left"></i> Back to Users
                    </a>
                </h2>
            </div>

            <div class="card-body">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-5 text-center">
                        <!-- User Image -->
                        <div class="user-image-container mb-4">
                            <img src="{{ getUserImage($user->id) }}" alt="{{ $user->name }}" class="user-image">
                        </div>

                        {{-- <div class="user-image-container mb-4">
                            <img src="{{ asset('uploads/Users/' . $user->id . '.jpg') }}" alt="{{ $user->name }}"
                                class="user-image">
                        </div> --}}
                    </div>
                    <div class="col-md-7">
                        <!-- User Info -->
                        <div class="user-details">
                            <h3 class="text-dark">{{ $user->name }}</h3>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Mobile:</strong> {{ $user->mobile_no }}</p>
                            <p><strong>Gender:</strong> {{ $user->gender }}</p>
                            <p><strong>Role:</strong> {{ $user->role == 2 ? 'Admin' : 'User' }}</p>
                            <p><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($user->birthday)->format('M j, Y') }}
                            </p>

                            <!-- Status -->
                            <p><strong>Status:</strong>
                                @if ($user->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Edit and Delete Actions -->
                <div class="d-flex justify-content-between mt-4">
                    <!-- Edit Button -->
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning text-white"><i
                            class="fas fa-edit"></i> Edit</a>
                    <!-- Delete Button -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script>
    // SweetAlert2 for delete confirmation
        $('form').on('submit', function(e) {
            // alert("Test");
            e.preventDefault();
        
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();  // Proceed with form submission
                }
            });
        });
</script>
@endsection