
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    {{-- <link rel="shortcut icon" href="{{ asset('front-assets/images/Myntra_logo.webp') }}" type="image/x-icon"> --}}
    <link rel="icon" type="image/png"
        href="data:image/png;base64,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"
        sizes="64x64" />
    <title>Online Shopping for Women, Men, Kids Fashion & Lifestyle - Myntra</title>

    <link href="{{ asset('front-assets/css/index-css/style.css ') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front-assets/css/index-css/utils.css ') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <header class="containerHeader">
        <nav class="flex space-between">
            <div class="left flex items-center">
                <img src="{{ asset('front-assets/images/Myntra_logo.webp') }}" />
                <ul class="flex items-center justify-center uppercase semibold">
                    <li>Men</li>
                    <li>Women</li>
                    <li>Kids</li>
                    <li>Home and Living</li>
                    <li>Beauty</li>
                    <li>Studio</li>
                </ul>

                {{-- <div class="right flex items-center"> --}}
                <input class="search" placeholder="Search for products, brands and more" class="desktop-searchBar"
                    value="" data-reactid="904">
                <div class="rightBox">
                    <div class="profile mx-2">Profile</div>
                    <div class="wishlist mx-2">WishList</div>
                    <div class="bag mx-2">Bag</div>
                </div>
                {{-- </div> --}}
            </div>
        </nav>
    </header>
    <section class="container section1">
        {{-- <img class="homeImg" src="{{ asset('front-assets/images/home.png') }}" /> --}}
        <img class="homeImg1" src="{{ asset('front-assets/images/Discount_coupon-01.jpg') }}" />
        <img class="homeImg2" src="{{ asset('front-assets/images/heroImage.png') }}" />
        <img class="homeImg2" draggable="false" class="image-image undefined image-hand"
            src="https://assets.myntassets.com/w_980,c_limit,fl_progressive,dpr_2.0/assets/images/2024/8/27/25d1c1ff-5230-40f6-baaf-262280ba6ce71724757084991-COUPONS-CORNER.jpg"
            srcset="">
        <img class="homeImg3" draggable="false" src="{{ asset('front-assets/images/coupons.jpg') }}">
        <img draggable="false" class=" homeImg image-image undefined "
            src="https://assets.myntassets.com/w_980,c_limit,fl_progressive,dpr_2.0/assets/images/2024/9/6/2d52a258-890d-46ab-93b6-2458a0f966ee1725589715550-Crazy-Deals.jpg"
            srcset="">

        <img draggable="false" class="homeImg image-image undefined "
            src="https://assets.myntassets.com/w_980,c_limit,fl_progressive,dpr_2.0/assets/images/2024/9/6/8acf3338-5e53-481c-960c-33b5cd05ff3c1725589715592-Shop-By-Category-----2.jpg"
            srcset="">

        {{-- Shop By category --}}
        <div class="catImgs1">
            <img src="{{ asset('front-assets/images/catImg01.jpg') }}" alt="Category Image 01">
            <img src="{{ asset('front-assets/images/catImg02.webp') }}" alt="Category Image 02">
            <img src="{{ asset('front-assets/images/catImg03.webp') }}" alt="Category Image 03">
            <img src="{{ asset('front-assets/images/catImg04.webp') }}" alt="Category Image 04">
            <img src="{{ asset('front-assets/images/catImg05.webp') }}" alt="Category Image 05">
            <img src="{{ asset('front-assets/images/catImg06.webp') }}" alt="Category Image 06">
        </div>
        <div class="catImgs2">
            <img src="{{ asset('front-assets/images/catImg01.jpg') }}" alt="Category Image 01">
            <img src="{{ asset('front-assets/images/catImg02.webp') }}" alt="Category Image 02">
            <img src="{{ asset('front-assets/images/catImg03.webp') }}" alt="Category Image 03">
            <img src="{{ asset('front-assets/images/catImg04.webp') }}" alt="Category Image 04">
            <img src="{{ asset('front-assets/images/catImg05.webp') }}" alt="Category Image 05">
            <img src="{{ asset('front-assets/images/catImg06.webp') }}" alt="Category Image 06">
        </div>
        {{-- Shop By category --}}

        <img draggable="false" class=" homeImg image-image undefined image-hand"
            src="https://assets.myntassets.com/w_980,c_limit,fl_progressive,dpr_2.0/assets/images/2024/8/27/97b7bd6e-8373-4b32-aec9-c511ae1a1f761724757504705-App-Install-Banner.jpg"
            srcset="">

    </section>


    <footer class="footer">
        <div class="footer-container">
            <!-- Column 1: ONLINE SHOPPING and USEFUL LINKS -->
            <div class="footer-section1">
                <h4>ONLINE SHOPPING</h4>
                <ul>
                    <li>Men</li>
                    <li>Women</li>
                    <li>Kids</li>
                    <li>Home & Living</li>
                    <li>Beauty</li>
                    <li>Gift Cards</li>
                    <li>Myntra Insider</li>
                </ul>

                <h4>USEFUL LINKS</h4>
                <ul>
                    <li>Blog</li>
                    <li>Careers</li>
                    <li>Site Map</li>
                    <li>Corporate Information</li>
                    <li>Whitehat</li>
                    <li>Cleartrip</li>
                </ul>
            </div>

            <!-- Column 2: CUSTOMER POLICIES -->
            <div class="footer-section2">
                <h4>CUSTOMER POLICIES</h4>
                <ul>
                    <li>Contact Us</li>
                    <li>FAQ</li>
                    <li>T&C</li>
                    <li>Terms Of Use</li>
                    <li>Track Orders</li>
                    <li>Shipping</li>
                    <li>Cancellation</li>
                    <li>Returns</li>
                    <li>Privacy policy</li>
                    <li>Grievance Officer</li>
                </ul>
            </div>

            <!-- Column 3: EXPERIENCE MYNTRA APP ON MOBILE and KEEP IN TOUCH -->
            <div class="footer-section3">
                <h4>EXPERIENCE MYNTRA APP ON MOBILE</h4>
                <div class="download-links">
                    <img class="StoreDownloadLinks desktop-androidDownLink"
                        src="https://constant.myntassets.com/web/assets/img/80cc455a-92d2-4b5c-a038-7da0d92af33f1539674178924-google_play.png"
                        alt="Google Play Store">
                    <img class="StoreDownloadLinks desktop-iOSDownLink"
                        src="https://constant.myntassets.com/web/assets/img/bc5e11ad-0250-420a-ac71-115a57ca35d51539674178941-apple_store.png"
                        alt="Apple App Store">
                </div>

                <h4>KEEP IN TOUCH</h4>
                <div class="social-media-links">
                    <img src="https://constant.myntassets.com/web/assets/img/d2bec182-bef5-4fab-ade0-034d21ec82e31574604275433-fb.png"
                        alt="Facebook" style="width: 20px; height: 20px;">
                    <img src="https://constant.myntassets.com/web/assets/img/f10bc513-c5a4-490c-9a9c-eb7a3cc8252b1574604275383-twitter.png"
                        alt="Twitter" style="width: 20px; height: 20px;">
                    <img src="https://constant.myntassets.com/web/assets/img/a7e3c86e-566a-44a6-a733-179389dd87111574604275355-yt.png"
                        alt="YouTube" style="width: 28px; height: 20px;">
                    <img src="https://constant.myntassets.com/web/assets/img/b4fcca19-5fc1-4199-93ca-4cae3210ef7f1574604275408-insta.png"
                        alt="Instagram" style="width: 20px; height: 22px; position: relative; top: 1px;">
                </div>
            </div>

            <!-- Column 4: 100% ORIGINAL guarantee -->
            <div class="footer-section4">
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

        <div class="PopularSearches">

            <div class="footer-container">
                <!-- Column 1: ONLINE SHOPPING and USEFUL LINKS -->
                <div class="footer-section1">
                    <h4 class="header-with-line">POPULAR SEARCHES
                        <hr>
                    </h4>

                    <div class="category-list">
                        <span>Makeup</span> |
                        <span>Dresses For Girls</span> |
                        <span>T-Shirts</span> |
                        <span>Sandals</span> |
                        <span>Headphones</span> |
                        <span>Babydolls</span> |
                        <span>Blazers For Men</span> |
                        <span>Handbags</span> |
                        <span>Ladies Watches</span> |
                        <span>Bags</span> |
                        <span>Sport Shoes</span> |
                        <span>Reebok Shoes</span> |
                        <span>Puma Shoes</span> |
                        <span>Boxers</span> |
                        <span>Wallets</span> |
                        <span>Tops</span> |
                        <span>Earrings</span> |
                        <span>Fastrack Watches</span> |
                        <span>Kurtis</span> |
                        <span>Nike Smart Watches</span> |
                        <span>Titan Watches</span> |
                        <span>Designer Blouse</span> |
                        <span>Gowns</span> |
                        <span>Rings</span> |
                        <span>Cricket Shoes</span> |
                        <span>Forever 21 Eye Makeup</span> |
                        <span>Photo Frames</span> |
                        <span>Punjabi Suits</span> |
                        <span>Bikini</span> |
                        <span>Myntra Fashion Show</span> |
                        <span>Lipstick</span> |
                        <span>Saree</span> |
                        <span>Watches</span> |
                        <span>Dresses</span> |
                        <span>Lehenga</span> |
                        <span>Nike Shoes</span> |
                        <span>Goggles</span> |
                        <span>Bras</span> |
                        <span>Suit</span> |
                        <span>Chinos</span> |
                        <span>Shoes</span> |
                        <span>Adidas Shoes</span> |
                        <span>Woodland Shoes</span> |
                        <span>Jewellery</span> |
                        <span>Designers</span> |
                        <span>Sarees</span>
                    </div>


                    <p class="footer-text">
                        <span class="footerSpan01">In case of any concern,</span>
                        <span class="footerSpan02">Contact Us © 2024 www.myntra.com.</span>
                        <span class="footerSpan03">All rights reserved. A Flipkart company</span>
                    </p>

                    <hr>
                </div>
            </div>

    </footer>




    {{-- <footer>
        Copyright &copy; myntra.com | All rights reserved
    </footer> --}}
    <script src="script.js"></script>
</body>

</html>

