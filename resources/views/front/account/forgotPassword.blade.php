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
                        <a href="{{route('front.wishlist')}}" class="nav-link me-2">
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

                <form class="bg-white p-4 shadow" action="{{ route('front.processForgotPassword') }}" method="post"
                    name="processForgotPasswordForm" id="processForgotPasswordForm">
                    @csrf
                    <div class="mt-4">
                        <h4>FORGOT PASSWORD</h4>
                    </div>

                    <!-- E - MAIL -->
                    <div class="mt-4">
                        <div class="input-group" style="border: 1px solid grey;">
                            <input type="email" class="form-control @error('email') is-invalid @enderror border-0" id="email" name="email" placeholder="Enter E-Mail" title="Enter Correct E-Mail">
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                  
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-danger">
                            <p class="mb-0">SUBMIT</p>
                        </button>
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-center pt-5 pb-2">
                        <a href="{{ route('account.login') }}" class="text-danger fw-bold">Login</a>
                    </div>
                    
                </form>
            
            </div>
        </div>
    </div>
</main>
