<!DOCTYPE html>
<html lang="en">

<head>
    <title>Myntra Functional Clone</title>
    <link rel="stylesheet" href="{{ asset('front-assets/clone_y/css/index.css') }}" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header>
        <div class="logo_container">
            <a href="#"><img class="myntra_home" src="{{ asset('front-assets/clone_y/images/myntra_logo.webp') }}"
                    alt="Myntra Home" /></a>
        </div>
        <nav class="nav_bar">
            @if (!empty(getSections()))
                @foreach (getSections() as $section)
                    <a href="#">{{ $section->name }}</a>
                @endforeach
            @endif


            {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if (!empty(getSections()))
                            @foreach (getSections() as $section)
                                <li class="nav-item dropdown mega-dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $section->name }}
                                    </a>
                                    @if ($section->categories->isNotEmpty())
                                        <div class="dropdown-menu mega-menu">
                                            <div class="container">
                                                @php
                                                    $categories = $section->categories;
                                                    $chunkedCategories = $categories->chunk(4);
                                                @endphp

                                                @foreach ($chunkedCategories as $chunk)
                                                    <div class="row">
                                                        @foreach ($chunk as $category)
                                                            <div class="col-md-3">
                                                                <h5 class="dropdown-header">{{ $category->name }}</h5>
                                                                @if ($category->subcategories->isNotEmpty())
                                                                    <ul class="list-unstyled">
                                                                        @foreach ($category->subcategories as $subcategory)
                                                                            <li>
                                                                                <a class="dropdown-item"
                                                                                    href="#">
                                                                                    {{ $subcategory->name }}
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    No subcategories
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
                </div> --}}




            {{-- <a href="#">Men</a>
            <a href="#">Women</a>
            <a href="#">Kids</a>
            <a href="#">Home & Living</a>
            <a href="#">Beauty</a>
            <a href="#">Studio <sup>New</sup></a> --}}
        </nav>
        <div class="search_bar">
            <span class="material-symbols-outlined search_icon">search</span>
            <input class="search_input" placeholder="Search for products, brands and more" />
        </div>
        <div class="action_bar">
            <div class="action_container">
                <span class="material-symbols-outlined action_icon">person</span>
                <span class="action_name">Profile</span>
            </div>

            <div class="action_container">
                <span class="material-symbols-outlined action_icon">favorite</span>
                <span class="action_name">Wishlist</span>
            </div>

            <a class="action_container" href=" {{ route('front.pages.bag') }} ">
                {{-- pages/bag.blade.php --}}
                <span class="material-symbols-outlined action_icon">shopping_bag</span>
                <span class="action_name">Bag</span>
                <span class="bag-item-count">0</span>
            </a>
        </div>
    </header>
    <main>
        <div class="items-container">

            <h1>This is Content Area</h1>
        </div>
    </main>

    <footer>
        <div class="footer_container">
            <!-- <div class="footer_column">
                <h3>ONLINE SHOPPING</h3>

                <a href="#">Men</a>
                <a href="#">Women</a>
                <a href="#">Kids</a>
                <a href="#">Home & Living</a>
                <a href="#">Beauty</a>
                <a href="#">Gift Card</a>
                <a href="#">Myntra Insider</a>
            </div>

            <div class="footer_column">
                <h3>ONLINE SHOPPING</h3>

                <a href="#">Men</a>
                <a href="#">Women</a>
                <a href="#">Kids</a>
                <a href="#">Home & Living</a>
                <a href="#">Beauty</a>
                <a href="#">Gift Card</a>
                <a href="#">Myntra Insider</a>
            </div>

            <div class="footer_column">
                <h3>ONLINE SHOPPING</h3>

                <a href="#">Men</a>
                <a href="#">Women</a>
                <a href="#">Kids</a>
                <a href="#">Home & Living</a>
                <a href="#">Beauty</a>
                <a href="#">Gift Card</a>
                <a href="#">Myntra Insider</a>
            </div> -->
        </div>
        <hr />

        <div class="copyright">
            © 2023 www.myntra.com. All rights reserved.
        </div>
    </footer>

    <script src=" {{ asset('front-assets/clone_y/data/items.js') }}"></script>
    <script src=" {{ asset('front-assets/clone_y/scripts/index.js') }}"></script>
</body>

</html>
