<!DOCTYPE html>
<html class="no-js" lang="en_AU" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Laravel Online Shop</title>
    <meta name="description" content="" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />

    <meta property="og:locale" content="en_AU" />
    <meta property="og:type" content="website" />
    <meta property="fb:admins" content="" />
    <meta property="fb:app_id" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="" />
    <meta property="og:image:height" content="" />
    <meta property="og:image:alt" content="" />

    <meta name="twitter:title" content="" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:description" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:image:alt" content="" />
    <meta name="twitter:card" content="summary_large_image" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/video-js.css') }}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
        rel="stylesheet">

    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front-assets/images/Myntra_logo.webp') }}" />





    <style>
        .carousel-base {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding-top: 20px;
            padding-bottom: 15px;
            margin: 0 auto;
        }

        .container-base {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            width: 100%;
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
        }

        footer {
            /* margin-top: 25px; */
            height: 55px;
            /* text-align: center; */
            background-color: #f7f7f7;
            padding-top: 28px;
            font-size: 14px;
            color: #696b79;
            text-decoration: none;
            font-family: Whitney, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto,
                Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: 100%;
            letter-spacing: 0.3px;
        }

        footer a {
            cursor: pointer;
            color: #696b79;
            text-decoration: none;
            font-weight: 500;
        }


        .footer-container {
            display: flex;
            flex-direction: column;
            background-color: #f7f7f7;
            padding-left: 100px;
            /* Reduced padding from 220px to 50px */
            padding-right: 80px;
            /* Reduced padding from 220px to 50px */
            width: 100%;
            /* Ensures the footer takes the full width of its container */

        }

        .row {
            display: flex;
            margin-bottom: 20px;
        }

        .online-shopping {
            text-align: left;
            margin-right: 50px;
        }

        .customer-policies {
            text-align: left;
            margin-right: 50px;
        }

        .app {
            text-align: left;
            margin-right: 90px;
        }

        /* .row-2 { */
        .customer-surity {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            text-align: left;
        }

        .content-heading {
            color: black;
            font-weight: 600;
            letter-spacing: normal;
        }

        .content-box {
            line-height: 1.6;
        }

        .para-content {
            margin-top: 25px;
            margin-bottom: 40px;
        }

        .copyright-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .horizontal-line {
            margin-bottom: 30px;
            opacity: 0.2;
            height: 0.3px;
        }

        .office-address-content {
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .other-info-heading {
            font-weight: 600;
            letter-spacing: normal;
            color: black;
            font-size: 15px;
            opacity: 0.8;
        }

        .other-info-para-content {
            margin-top: 8px;
            margin-bottom: 30px;
            font-size: 13px;
            opacity: 0.8;
        }

        .Google-play {
            background-repeat: none;
            margin-right: 10px;
        }

        .App-Store {
            background-repeat: none;
        }

        .download-button {
            display: flex;
            margin-top: 30px;
        }

        .download-button img {
            width: 130px;
            height: 40px;
        }

        .original {
            margin-bottom: 30px;
            color: black;
            opacity: 0.8;
        }

        /* .customer-satisfaction {
    margin-bottom: 30px;
} */
        .footer-item {
            display: flex;
            align-items: center;
            /* Aligns items vertically centered */
            margin-bottom: 10px;
            /* Space between items */
        }

        .footer-item img {
            margin-right: 10px;
            /* Space between image and text */
        }

        .social-links {
            margin-top: 12px;
        }

        .fb-icon {
            margin-right: 6px;
        }

        .tw-icon {
            margin-right: 6px;
        }

        .yt-icon {
            margin-right: 6px;
        }


        .section7 img {
            cursor: pointer;
            width: 100vw;
            background-size: cover;
        }

        .section8 {
            display: flex;
            justify-content: center;
        }
    </style>

</head>

<body data-instant-intensity="mousedown">



    <header class="bg-white">
        <div class="container">
            <nav class="navbar navbar-expand-xl" id="navbar">

                <a href="#">
                    <img class="myntra_home" src="{{ asset('front-assets/images/Myntra_logo.webp') }}"
                        alt="Myntra Home ( Logo )" /></a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @if (!empty(getSections()))
                            @foreach (getSections() as $section)
                                <li class="nav-item dropdown mega-dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false"> {{ $section->name }} </a>
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

                    <form action="">
                        <div class="input-group">
                            <input type="text" placeholder="Search For Products" class="form-control"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </form>
                </div>

                {{-- <div class="right-nav py-0">
                    <a href="cart.php" class="ml-3 d-flex pt-2">
                        <i class="fas fa-shopping-cart text-primary"></i>
                    </a>
                </div> --}}
            </nav>
        </div>
    </header>

    <main>
        {{-- First Image : Discount Coupons --}}
        <img src="{{ asset('front-assets/images/DiscountCoupon.jpg') }}" alt="Discount Coupon">
        {{-- Second Image : Hero Image --}}
        <img src="{{ asset('front-assets/images/heroImage.png') }}" alt="Hero Image">
        {{-- Third Image : Coupon Corner --}}
        <img src="{{ asset('front-assets/images/CouponCorner.jpg') }}" alt="Coupon Corner">
        {{-- Fourth Image : Coupons --}}
        <img src="{{ asset('front-assets/images/coupons.jpg') }}" alt="Coupons">
        {{-- Fifth Image : Crazy Deals --}}
        <img src="{{ asset('front-assets/images/CrazyDeals.jpg') }}" alt="Crazy Deals">

        {{-- Section : Category Showcase --}}
        <!-- Bootstrap 5 Carousel for Categories and Subcategories -->
        <div id="categoryCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Category 1 -->
                <div class="carousel-item active">
                    <div class="container">
                        <h3>Category 1</h3>
                        <div class="row">
                            <!-- Subcategory 1.1 -->
                            <div class="col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card">
                                        <img src="subcategory1.jpg" class="card-img-top" alt="Subcategory 1.1">
                                        <div class="card-body">
                                            <p class="card-text">Subcategory 1.1</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Subcategory 1.2 -->
                            <div class="col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card">
                                        <img src="subcategory2.jpg" class="card-img-top" alt="Subcategory 1.2">
                                        <div class="card-body">
                                            <p class="card-text">Subcategory 1.2</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Subcategory 1.3 -->
                            <div class="col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card">
                                        <img src="subcategory3.jpg" class="card-img-top" alt="Subcategory 1.3">
                                        <div class="card-body">
                                            <p class="card-text">Subcategory 1.3</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Subcategory 1.4 -->
                            <div class="col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card">
                                        <img src="subcategory4.jpg" class="card-img-top" alt="Subcategory 1.4">
                                        <div class="card-body">
                                            <p class="card-text">Subcategory 1.4</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category 2 -->
                <div class="carousel-item">
                    <div class="container">
                        <h3>Category 2</h3>
                        <div class="row">
                            <!-- Subcategory 2.1 -->
                            <div class="col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card">
                                        <img src="subcategory5.jpg" class="card-img-top" alt="Subcategory 2.1">
                                        <div class="card-body">
                                            <p class="card-text">Subcategory 2.1</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Subcategory 2.2 -->
                            <div class="col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card">
                                        <img src="subcategory6.jpg" class="card-img-top" alt="Subcategory 2.2">
                                        <div class="card-body">
                                            <p class="card-text">Subcategory 2.2</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Subcategory 2.3 -->
                            <div class="col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card">
                                        <img src="subcategory7.jpg" class="card-img-top" alt="Subcategory 2.3">
                                        <div class="card-body">
                                            <p class="card-text">Subcategory 2.3</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Subcategory 2.4 -->
                            <div class="col-md-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card">
                                        <img src="subcategory8.jpg" class="card-img-top" alt="Subcategory 2.4">
                                        <div class="card-body">
                                            <p class="card-text">Subcategory 2.4</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- More categories as needed -->
            </div>

            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <li data-bs-target="#categoryCarousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#categoryCarousel" data-bs-slide-to="1"></li>
                <!-- Add more indicators as needed -->
            </ol>
        </div>


        {{-- Working For Single Image --}}
        {{-- @if (!empty(getSections()))
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

                <div class="carousel-indicators">
                    @foreach (getSections() as $key => $section)
                        <button type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"
                            aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach (getSections() as $key => $section)
                        @if ($section->image != '')
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="10000">
                                <img src="{{ asset('uploads/Sections/' . $section->image) }}"
                                    class="d-block w-25 center" alt="Slider Image {{ $key + 1 }}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $section->name }}</h5>
                                    <p>{{ $section->description }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        @endif --}}


        {{-- Sixth Image : Shop By Category Image --}}
        <img src="{{ asset('front-assets/images/myntra-shop-by-category.jpg') }}" alt="Shop By Category">

        {{-- Section : Category Showcase --}}
        <section class="section-3">
            <div class="container">
                <div class="section-title">
                    <h2>Categories</h2>
                </div>

                @if (!empty(getSubCategories()))
                    <div class="row pb-3">
                        @foreach (getSubCategories() as $subcategory)
                            <div class="col-lg-3">
                                <div class="cat-card">
                                    <div class="left">
                                        @if ($subcategory->image != '')
                                            <img src="{{ asset('uploads/subcategory/' . $subcategory->image) }}"
                                                alt="" class="img-fluid category-images">
                                        @endif
                                    </div>
                                    <div class="right">
                                        <div class="cat-data">
                                            <h2>{{ $subcategory->name }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

    </main>

    <footer>
        <div class="footer-container">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="online-shopping col-3">
                            <span class="content-heading">ONLINE SHOPPING</span>
                            <div class="content-box">
                                <br>
                                Men
                                <br>
                                Women
                                <br>
                                Kids
                                <br>
                                Home & Living
                                <br>
                                Beauty
                                <br>
                                Gift Cards
                                <br>
                                Myntra Insider
                            </div>
                            <br>
                            <span class = "content-heading">USEFUL LINKS</span>
                            <div class="content-box">
                                <br>
                                Blog
                                <br>
                                Careers
                                <br>
                                Site Map
                                <br>
                                Corporate Information
                                <br>
                                Whitehat
                            </div>

                        </div>
                        <div class="customer-policies col-3">
                            <span class = "content-heading">CUSTOMER POLICIES</span>
                            <div class="content-box">
                                <br>
                                Contact Us
                                <br>
                                FAQ
                                <br>
                                T&C
                                <br>
                                Terms Of Use
                                <br>
                                Track Orders
                                <br>
                                Shipping
                                <br>
                                Cancellation
                                <br>
                                Returns
                                <br>
                                Privacy policy
                                <br>
                                Grievance Officer
                            </div>
                        </div>
                        <div class=" col-3">
                            <span class="content-heading ">EXPERINCE MYNTRA APP ON MOBILE</span>
                            <div class="download-button">
                                <div class="Google-play">
                                    <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/google-play.png"
                                        alt="google play">
                                </div>
                                <div class="App-Store">
                                    <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/app-store.png"
                                        alt="app store">
                                </div>
                            </div>
                            <br>
                            <div class="links-container">
                                <span class="content-heading">KEEP IN TOUCH</span>
                                <div class="social-links">
                                    <span class="fb-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24"
                                            fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                        </svg>
                                    </span>
                                    <span class="tw-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24"
                                            fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                            <path
                                                d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                        </svg>
                                    </span>
                                    <span class="yt-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24"
                                            fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                            <path
                                                d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                                        </svg>
                                    </span>
                                    <span class="ig-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24"
                                            fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                            <path
                                                d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="px-5 col-4">
                    <div class="customer-satisfaction">
                        <div class="row">
                            <div class="col-2">
                                <img src="https://constant.myntassets.com/web/assets/img/6c3306ca-1efa-4a27-8769-3b69d16948741574602902452-original.png"
                                    style="width: 48px; height: 40px;">
                            </div>
                            <div class="col-10"> <strong class="original"> 100% ORIGINAL</strong> guarantee <br>
                                for all products at myntra.com</div>
                        </div>

                    </div>
                    <div>
                        <div class="row">
                            <div class="col-2"> <img
                                    src="https://assets.myntassets.com/assets/images/retaillabs/2023/5/22/becb1b16-86cc-4e78-bdc7-7801c17947831684737106127-Return-Window-image.png"
                                    style="width: 48px; height: 49px;"></div>
                            <div class="col-10"> <strong class="original">Return within 30days </strong>of <br>
                                receiving your order</div>
                        </div>


                    </div>
                </div>
            </div>
            <hr>
            <div class="popular-searches">
                <Span class="content-heading">POPULAR SEARCHES</Span>
                <br>
                <p class="para-content">
                    Makeup | Dresses For Girls | T-Shirts | Sandals | Headphones | Babydolls | Blazers For Men |
                    Handbags | Ladies Watches | Bags | Sport Shoes || Reebok Shoes | Puma Shoes | Boxers | Wallets |
                    Tops | Earrings | Fastrack Watches | Kurtis | Nike | Smart Watches | Titan Watches | Designer Blouse
                    | Gowns | Rings | Cricket Shoes | Forever 21 | Eye Makeup | Photo Frames | Punjabi Suits | Myntra
                    Fashion Show | Lipstick | Saree | Watches | Dresses | Lehenga | Nike Shoes | Goggles | Suit | Chinos
                    | Shoes | Adidas Shoes | Woodland Shoes | Jewellery | Designers Sarees
                </p>
                <div class="copyright-container">
                    <div class="col-4">In case of any concern, Contact Us</div>
                    <div class="col-6">© 2024 www.myntra.com. All rights reserved.</div>
                    <div class="col-3">A Flipkart company</div>
                </div>
            </div>
            <hr class="horizontal-line">
            <div class="office-address">
                <span class="content-heading">Registered Office Address</span>
                <div class="office-address-content">
                    <br>
                    Building Alyssa
                    <br>
                    Begonia and Clover situated in Embassy Tech Village,
                    <br>
                    Outer Ring Road,
                    <br>
                    Devarabeesanahalli Village,
                    <br>
                    Varthur Hobli,
                    <br>
                    Bengaluru-560103, India
                </div>
            </div>
            <hr class="horizontal-line">
            <div class="online-shopping">
                <span class="other-info-heading">ONLINE SHOPPING MADE EASY AT MYNTRA</span>
                <p class="other-info-para-content">If you would like to experience the best of online shopping for men,
                    women and kids in India, you are at the right place. Myntra is the ultimate destination for fashion
                    and lifestyle, being host to a wide array of merchandise including clothing, footwear, accessories,
                    jewellery, personal care products and more. It is time to redefine your style statement with our
                    treasure-trove of trendy items. Our online store brings you the latest in designer products straight
                    out of fashion houses. You can shop online at Myntra from the comfort of your home and get your
                    favourites delivered right to your doorstep.</p>
            </div>

            <div class="myntra-app">
                <span class="other-info-heading">MYNTRA APP</span>
                <p class="other-info-para-content">
                    Myntra, India's no. 1 online fashion destination justifies its fashion relevance by bringing
                    something new and chic to the table on the daily. Fashion trends seem to change at lightning speed,
                    yet the Myntra shopping app has managed to keep up without any hiccups. In addition, Myntra has
                    vowed to serve customers to the best of its ability by introducing its first-ever loyalty program,
                    The Myntra Insider. Gain access to priority delivery, early sales, lucrative deals and other special
                    perks on all your shopping with the Myntra app. Download the Myntra app on your Android or IOS
                    device today and experience shopping like never before!
                </p>
            </div>
            <div class="history">
                <span class="other-info-heading">HISTORY OF MYNTRA</span>
                <div class="other-info-para-content">
                    <p>
                        Becoming India's no. 1 fashion destination is not an easy feat. Sincere efforts, digital
                        enhancements and a team of dedicated personnel with an equally loyal customer base have made
                        Myntra the online platform that it is today. The original B2B venture for personalized gifts was
                        conceived in 2007 but transitioned into a full-fledged ecommerce giant within a span of just a
                        few years. By 2012, Myntra had introduced 350 Indian and international brands to its platform,
                        and this has only grown in number each passing year. Today Myntra sits on top of the online
                        fashion game with an astounding social media following, a loyalty program dedicated to its
                        customers, and tempting, hard-to-say-no-to deals.
                    </p>
                    <br>
                    <p>
                        The Myntra shopping app came into existence in the year 2015 to further encourage customers’
                        shopping sprees. Download the app on your Android or IOS device this very minute to experience
                        fashion like never before
                    </p>
                </div>

            </div>
            <div class="shop-at-myntra">
                <span class="other-info-heading">SHOP ONLINE AT MYNTRA WITH COMPLETE CONVENIENCE</span>
                <div class="other-info-para-content">
                    <p>
                        Another reason why Myntra is the best of all online stores is the complete convenience that it
                        offers. You can view your favourite brands with price options for different products in one
                        place. A user-friendly interface will guide you through your selection process. Comprehensive
                        size charts, product information and high-resolution images help you make the best buying
                        decisions. You also have the freedom to choose your payment options, be it card or
                        cash-on-delivery. The 30-day returns policy gives you more power as a buyer. Additionally, the
                        try-and-buy option for select products takes customer-friendliness to the next level.
                    </p>
                    <br>
                    <p>
                        Enjoy the hassle-free experience as you shop comfortably from your home or your workplace. You
                        can also shop for your friends, family and loved-ones and avail our gift services for special
                        occasions.
                    </p>
                </div>
            </div>

        </div>

    </footer>

    <script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/custom.js') }}"></script>
    <script>
        window.onscroll = function() {
            myFunction()
        };

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
</body>

</html>