<header class="bg-white">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-white" id="navbar">

            <!-- Brand Logo -->
            <a href="{{route('front.home')}}" class="navbar-brand">
            {{-- <img class="myntra_home" src="{{ asset('front-assets/images/Myntra_logo.webp') }}" alt="Myntra Home ( Logo )" /> --}}
            <img class="myntra_home" src="{{ getLogo() }}" alt="Myntra Home ( Logo )" />
            </a>

            <!-- Toggler for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar Links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (!empty(getSections()))
                        @foreach (getSections() as $section)
                            <li class="nav-item dropdown mega-dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $section->name }}
                                </a>
            
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
                    <form action="{{route('front.shop')}}" class="d-flex me-3">
                        <div class="input-group">
                            <input type="text" placeholder="Search For Products" class="form-control" 
                            name="search" id="search" value="{{Request::get('search')}}">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
            
                    <!-- Additional Icons after the Search Bar -->
                    <div class="navbar-icons d-flex align-items-center">
                        <!-- Profile Icon -->
                        <a href="{{route('account.login')}}" class="nav-link me-2">
                            <i class="fas fa-user text-primary"></i>
                        </a>
            
                        <!-- Wishlist Icon -->
                        <a href="{{route('front.wishlist')}}" class="nav-link me-2">
                            <i class="fas fa-heart text-primary"></i>
                        </a>
            
                        <!-- Shop Icon -->
                        <a href="{{route('front.shop')}}" class="nav-link me-2">
                            <i class="fas fa-store text-primary"></i>
                        </a>
            
                        <!-- Shopping Cart Icon -->
                        <a href="{{ route('front.cart') }}" class="nav-link me-2">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </a>
                    </div>
                </div>
                <ul class="d-none">
                    <li>
                        <a class="dropdown-item" href="{{ url('/lang/en') }}">
                            English
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/lang/hi') }}">
                            हिंदी
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('/lang/ur') }}">
                            اردو
                        </a>
                    </li>
                </ul>
                {{-- {{ Session()->get('locale') }} --}}

                <ul class="navbar-nav">
                   <li class="nav-item dropdown mega-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">LANG</a>

                        <div class="dropdown-menu lang-menu" style="width: auto; padding-right: 0; min-width: auto;">
                            <ul class="">
                                <li><a class="dropdown-item" href="{{ url('/lang/en') }}">ENGLISH</a></li>
                                <li><a class="dropdown-item" href="{{ url('/lang/hi') }}">HINDI</a></li>
                                <li><a class="dropdown-item" href="{{ url('/lang/ur') }}">URDU</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
             
            </div>
        </nav>
    </div>
</header>