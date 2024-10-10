@include('front.layouts.head')
<header class="bg-white">
    <div class="container">
        <nav class="navbar navbar-expand-xl navbar-light bg-white" id="navbar">

            <!-- Brand Logo -->
            <a href="{{ route('front.home') }}" class="navbar-brand">
                <img class="myntra_home" src="{{ asset('front-assets/images/Myntra_logo.webp') }}"
                    alt="Myntra Home ( Logo )" />
            </a>

            <!-- Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (!empty(getSections()))
                        @foreach (getSections() as $section)
                            <li class="nav-item dropdown mega-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    aria-expanded="false"> {{ $section->name }} </a>

                                <!-- Dropdown Menu -->
                                @if ($section->categories->isNotEmpty())
                                    <div class="dropdown-menu mega-menu p-3">
                                        <div class="container">
                                            @php
                                                $categories = $section->categories;
                                                $chunkedCategories = $categories->chunk(4); // Categories are chunked for layout
                                            @endphp
                                            @foreach ($chunkedCategories as $chunk)
                                                <div class="row">
                                                    @foreach ($chunk as $category)
                                                        <div class="col-md-3 col-sm-6">
                                                            <h5 class="dropdown-header">{{ $category->name }}</h5>
                                                            @if ($category->subcategories->isNotEmpty())
                                                                <ul class="list-unstyled">
                                                                    @foreach ($category->subcategories as $subcategory)
                                                                        <li>
                                                                            <a class="dropdown-item" href="#">
                                                                                {{ $subcategory->name }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>

                <!-- Search Bar with Icons -->
                <div class="d-flex align-items-center">
                    <form action="" class="d-flex mt-3" id="SearchForm" name="SearchForm">
                        <div class="input-group">
                            <input type="text" placeholder="Search For Products" class="form-control"
                                aria-label="Search for Products">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Additional Icons after the Search Bar -->
                    <div class="navbar-icons d-flex align-items-center">

                        <!-- Wishlist Icon -->
                        <a href="#wishlist" class="nav-link me-2">
                            <i class="fas fa-heart text-primary"></i>
                        </a>

                        <!-- Shop Icon -->
                        <a href="{{ route('front.shop') }}" class="nav-link me-2">
                            <i class="fas fa-store text-primary"></i>
                        </a>

                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>


<main>
    <div id="Login_form" class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-lg-4">
                @if (Session::has('success'))
                    <div class="alert alert-success mb-3"> {!! Session::get('success') !!} </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger mb-3"> {{ Session::get('error') }} </div>
                @endif

                <div class="text-center">
                    <img src="{{ asset('front-assets/images/Login.jpg') }}" class="img-fluid" alt="Login Image" />
                </div>

                <form class="bg-white p-4 shadow" action="{{ route('account.authenticate') }}" method="post"
                    name="loginForm" id="loginForm">
                    @csrf
                    <div class="mt-4">
                        <h4>Login <span> or </span> Signup</h4>
                    </div>

                    <!-- Mobile Number Input -->
                    <div class="mt-4">

                        <div class="input-group" style="border: 1px solid grey;">
                            <span class="input-group-text bg-white border-0">+91 | </span>
                            <input type="text" class="form-control @error('mobile_no') is-invalid @enderror border-0"
                                id="mobile_no" name="mobile_no" placeholder="Enter Number" pattern="[1-9]{1}[0-9]{9}"
                                title="Enter Correct Number" value="{{ old('mobile_no') }}">
                        </div>
                        @error('mobile_no')
                            <p class="text-danger">{{ $message }}</p> <!-- Validation error for mobile number -->
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mt-4">

                        <div class="input-group" style="border: 1px solid grey;">
                            <input type="password" class="form-control border-0 @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password" title="Password"
                                value="{{ old('password') }}">
                        </div>
                        @error('password')
                            <p class="text-danger">{{ $message }}</p> <!-- Validation error for password -->
                        @enderror
                    </div>

                    <p class="text-muted mt-4" style="font-size: 10px;">
                        By continuing, I agree to the <a href="#"
                            class="text-decoration-none fw-bold text-danger">Terms of Use</a> &
                        <a href="#" class="text-decoration-none fw-bold text-danger">Privacy Policy</a>
                    </p>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-danger">
                            <p class="mb-0">CONTINUE</p>
                        </button>
                    </div>

                    <p class="text-muted mt-4 pb-5" style="font-size: 10px;">Have trouble logging in?
                        <a href="#" class="text-danger fw-bold">Get help</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</main>

{{-- <script>
    $("#registrationForm").submit(function(event) {
        event.preventDefault();
        console.log('ffffffffff')

        $.ajax({
            url: "{{ route('account.authenticate') }}",
            type: "post",
            data: $(this).serializeArray(),
            dataType: "json",
            success: function(response) {
                var errors = response.errors;

                // Handle validation errors
                if (response.status === false) {
                    
                    if (errors.mobile_no) {
                        $("#mobile_no").addClass("is-invalid").next('.invalid-feedback').html(errors
                            .mobile_no);
                    } else {
                        $("#mobile_no").removeClass("is-invalid").next('.invalid-feedback').html(
                            "");
                    }
                    if (errors.password) {
                        $("#password").addClass("is-invalid").next('.invalid-feedback').html(errors
                            .password);
                    } else {
                        $("#password").removeClass("is-invalid").next('.invalid-feedback').html("");
                    }
                } else {
                    // If no errors, clear inputs and redirect to login
                    $("#mobile_no, #password").removeClass("is-invalid").next(
                        '.invalid-feedback').html("");
                    window.location.href = "{{ route('account.profile') }}";
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something went wrong.");
            }
        });
    });
</script> --}}
