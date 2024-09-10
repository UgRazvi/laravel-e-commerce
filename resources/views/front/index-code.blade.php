<!DOCTYPE html>
<html lang="en">

{{-- Head Section Starts --}}

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png"
        href="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/logo.png" />

    <link rel="stylesheet" href="{{ asset('front-assets/css/myntra-style.css') }}">
    <title>Online Shopping for Women, Men, Kids Fashion & Lifestyle - Myntra</title>


    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/video-js.css') }}" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" /> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
        rel="stylesheet">



</head>
{{-- Head Section Starts --}}

{{-- Body Section Starts --}}

<body>
    {{-- Nav Section Starts --}}
    <nav>
        <div class="left">
            <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/logo.png"
                alt="">

            <ul>
                {{-- First : Not working --}}
                {{-- @foreach (getSections() ?? [] as $section)
                    <li class="{{ $section->slug }}" id="section-{{ $section->id }}"> {{ $section->name }} </li>
                    <div class="men-section-items visibility" id="items-{{ $section->id }}">
                        <div class="col-1">
                            <div class="category">
                                <div class="category-items">
                                    @foreach ($section->category() ?? [] as $category)
                                        <a href=""> {{ $category->name }} </a>
                                        @foreach ($category->getSubCategories() ?? [] as $subcategory)
                                            <a href=""> {{ $subcategory->name }} </a>
                                            <br>
                                        @endforeach
                                    @endforeach
                                </div>
                                <hr class="horizontal-line2">
                            </div>
                        </div>
                    </div>
                @endforeach --}}


            </ul>
            {{-- Second : Working --}}
            {{-- @if (!empty(getSections()))
                @foreach (getSections() as $section)
                    <ul>
                        <li class="{{ $section->slug }}-section-items "> {{ $section->name }} </li>
                        <li>
                            {{ $section->name }}
                            @if ($section->categories->isNotEmpty())
                                <ul>
                                    @foreach ($section->categories as $category)
                                        <li>
                                            {{ $category->name }}
                                            @if ($category->subcategories->isNotEmpty())
                                                <ul>
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <li>{{ $subcategory->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    </ul>
                @endforeach
            @endif --}}

            {{-- Third : ChatGPT --}}

            @if (!empty(getSections()))
                @foreach (getSections() as $section)
                    <ul>
                        <li id="section-{{ $section->id }}" class="{{ $section->slug }}-section-items">
                            {{ $section->name }}
                        </li>
                        <li>
                            {{ $section->name }}
                            @if ($section->categories->isNotEmpty())
                                <ul>
                                    @foreach ($section->categories as $category)
                                        <li>
                                            {{ $category->name }}
                                            @if ($category->subcategories->isNotEmpty())
                                                <ul>
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <li>{{ $subcategory->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    </ul>
                @endforeach
            @endif


            {{-- style="position: fixed; top:100px;" --}}


            {{--  <li class="men">Men</li>
                <li class="women">Women</li>
                <li class="kids">Kids</li>
                <li class="homeliving">Home&Living</li>
                <li class="beauty">Beauty</li>
                <li class="studio">Studio</li> --}}

        </div>
        <div class="right">
            <input placeholder="Search for products, brands and more" class="desktop-searchBar" value=""
                data-reactid="904">
            <div class="icons">
                <div class="profile">Profile</div>
                <div class="wish">Wishlist</div>
                <div class="bag">Bag</div>
            </div>
        </div>
    </nav>
    {{-- Nav Section Ends --}}

    {{-- @dd(getSections()) --}}

    {{-- Content Section Starts --}}

    <div class="container">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/ss1.png"
            alt="">
    </div>
    <div class="section">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic1.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic2.webp"
            alt="">
    </div>
    <div class="section1">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic3.webp"
            alt="">
    </div>
    <div class="section2">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic4.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic6.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic7.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic8.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic9.webp"
            alt="">
    </div>
    <div class="section3">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic5.webp"
            alt="">
    </div>
    <div class="section4">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic10.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic11.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic12.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic13.jpg"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic14.webp"
            alt="">
    </div>
    <div class="section5">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic15.webp"
            alt="">
    </div>
    <div class="section6">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic16.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic17.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic18.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic19.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic20.webp"
            alt="">
    </div>
    <div class="section7">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic21.webp"
            alt="">
    </div>
    <div class="section8">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic22.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic23.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic24.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic25.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic26.webp"
            alt="">
        <img src="https://raw.githubusercontent.com/ZeroOctave/ZeroOctave-Javascript-Projects/main/assets/Images/myntraclone/pic27.jpg"
            alt="">
    </div>

    {{-- Main Content Section Ends --}}


    {{-- Footer Section Starts --}}
    <footer>
        <div class="footer-container">
            <div class="row">
                <div class="online-shopping">
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
                <div class="customer-policies">
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
                <div class="app">
                    <span class="content-heading">EXPERINCE MYNTRA APP ON MOBILE</span>
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                </svg>
                            </span>
                            <span class="tw-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                                    <path
                                        d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                </svg>
                            </span>
                            <span class="yt-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                    <path
                                        d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                                </svg>
                            </span>
                            <span class="ig-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="customer-surity">
                    {{-- <div class="customer-satisfaction">
                        <strong class="original"> 100% ORIGINAL</strong>
                        guarantee <br>
                        for all products at myntra.com</div>
                    <div><strong class="original">Return within 30days </strong>of <br>
                        receiving your order</div> --}}
                    <div class="footer-item">
                        <img src="https://constant.myntassets.com/web/assets/img/6c3306ca-1efa-4a27-8769-3b69d16948741574602902452-original.png"
                            style="width: 48px; height: 40px;">
                        <p><b>100% ORIGINAL</b> guarantee for all products at myntra.com</p>
                    </div>
                    <div class="footer-item">
                        <img src="https://assets.myntassets.com/assets/images/retaillabs/2023/5/22/becb1b16-86cc-4e78-bdc7-7801c17947831684737106127-Return-Window-image.png"
                            style="width: 48px; height: 49px;">
                        <p><b>Return within 14 days</b> of receiving your order</p>
                    </div>
                </div>
            </div>

            {{-- Popular Searches --}}
            <div class="popular-searches">
                <Span class="content-heading">POPULAR SEARCHES</Span>
                <br>
                <p class="para-content">
                    Makeup | Dresses For Girls | T-Shirts | Sandals | Headphones | Babydolls | Blazers For Men |
                    Handbags | Ladies Watches | Bags | Sport Shoes || Reebok Shoes | Puma Shoes | Boxers |
                    Wallets |
                    Tops | Earrings | Fastrack Watches | Kurtis | Nike | Smart Watches | Titan Watches |
                    Designer Blouse
                    | Gowns | Rings | Cricket Shoes | Forever 21 | Eye Makeup | Photo Frames | Punjabi Suits |
                    Myntra
                    Fashion Show | Lipstick | Saree | Watches | Dresses | Lehenga | Nike Shoes | Goggles | Suit
                    | Chinos
                    | Shoes | Adidas Shoes | Woodland Shoes | Jewellery | Designers Sarees
                </p>
                <div class="copyright-container">
                    <div>In case of any concern, Contact Us</div>
                    <div> © 2022 <a href="#">www.myntra.com</a> All right reserved.</div>

                </div>
            </div>
            <hr class="horizontal-line">
            {{-- Office Address --}}
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
            {{-- Online Shoppping --}}
            <div class="online-shopping">
                <span class="other-info-heading">ONLINE SHOPPING MADE EASY AT MYNTRA</span>
                <p class="other-info-para-content">If you would like to experience the best of online shopping
                    for men,
                    women and kids in India, you are at the right place. Myntra is the ultimate destination for
                    fashion
                    and lifestyle, being host to a wide array of merchandise including clothing, footwear,
                    accessories,
                    jewellery, personal care products and more. It is time to redefine your style statement with
                    our
                    treasure-trove of trendy items. Our online store brings you the latest in designer products
                    straight
                    out of fashion houses. You can shop online at Myntra from the comfort of your home and get
                    your
                    favourites delivered right to your doorstep.</p>
            </div>
            {{-- Myntra App --}}
            <div class="myntra-app">
                <span class="other-info-heading">MYNTRA APP</span>
                <p class="other-info-para-content">
                    Myntra, India's no. 1 online fashion destination justifies its fashion relevance by bringing
                    something new and chic to the table on the daily. Fashion trends seem to change at lightning
                    speed,
                    yet the Myntra shopping app has managed to keep up without any hiccups. In addition, Myntra
                    has
                    vowed to serve customers to the best of its ability by introducing its first-ever loyalty
                    program,
                    The Myntra Insider. Gain access to priority delivery, early sales, lucrative deals and other
                    special
                    perks on all your shopping with the Myntra app. Download the Myntra app on your Android or
                    IOS
                    device today and experience shopping like never before!
                </p>
            </div>
            {{-- History --}}
            <div class="history">
                <span class="other-info-heading">HISTORY OF MYNTRA</span>
                <div class="other-info-para-content">
                    <p>
                        Becoming India's no. 1 fashion destination is not an easy feat. Sincere efforts, digital
                        enhancements and a team of dedicated personnel with an equally loyal customer base have
                        made
                        Myntra the online platform that it is today. The original B2B venture for personalized
                        gifts was
                        conceived in 2007 but transitioned into a full-fledged ecommerce giant within a span of
                        just a
                        few years. By 2012, Myntra had introduced 350 Indian and international brands to its
                        platform,
                        and this has only grown in number each passing year. Today Myntra sits on top of the
                        online
                        fashion game with an astounding social media following, a loyalty program dedicated to
                        its
                        customers, and tempting, hard-to-say-no-to deals.
                    </p>
                    <br>
                    <p>
                        The Myntra shopping app came into existence in the year 2015 to further encourage
                        customers’
                        shopping sprees. Download the app on your Android or IOS device this very minute to
                        experience
                        fashion like never before
                    </p>
                </div>

            </div>
            {{-- Shop At Myntra --}}
            <div class="shop-at-myntra">
                <span class="other-info-heading">SHOP ONLINE AT MYNTRA WITH COMPLETE CONVENIENCE</span>
                <div class="other-info-para-content">
                    <p>
                        Another reason why Myntra is the best of all online stores is the complete convenience
                        that it
                        offers. You can view your favourite brands with price options for different products in
                        one
                        place. A user-friendly interface will guide you through your selection process.
                        Comprehensive
                        size charts, product information and high-resolution images help you make the best
                        buying
                        decisions. You also have the freedom to choose your payment options, be it card or
                        cash-on-delivery. The 30-day returns policy gives you more power as a buyer.
                        Additionally, the
                        try-and-buy option for select products takes customer-friendliness to the next level.
                    </p>
                    <br>
                    <p>
                        Enjoy the hassle-free experience as you shop comfortably from your home or your
                        workplace. You
                        can also shop for your friends, family and loved-ones and avail our gift services for
                        special
                        occasions.
                    </p>
                </div>
            </div>

        </div>

    </footer>
    {{-- Footer Section Ends --}}

    {{-- Footer JS --}}
    <script src="{{ asset('front-assets/js/myntra-script.js') }}"></script>

    {{-- Other JS --}}
    <script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('front-assets/js/custom.js') }}"></script>
    {{-- Nav Bar JS --}}
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
{{-- Body Section Starts --}}

</html>
