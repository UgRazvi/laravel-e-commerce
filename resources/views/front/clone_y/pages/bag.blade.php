<!DOCTYPE html>
<html lang="en">

<head>
    <title>Myntra Clone</title>
    <link rel="stylesheet" href="{{ asset('front-assets/clone_y/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('front-assets/clone_y/css/bag.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header>
        <div class="logo_container">
            <a href="#"><img class="myntra_home" src="{{ asset('front-assets/clone_y/images/myntra_logo.webp') }}" alt="Myntra Home"></a>
        </div>
        <nav class="nav_bar">
            <a href="#">Men</a>
            <a href="#">Women</a>
            <a href="#">Kids</a>
            <a href="#">Home & Living</a>
            <a href="#">Beauty</a>
            <a href="#">Studio <sup>New</sup></a>
        </nav>
        <div class="search_bar">
            <span class="material-symbols-outlined search_icon">search</span>
            <input class="search_input" placeholder="Search for products, brands and more">
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

            <div class="action_container">
                <span class="material-symbols-outlined action_icon">shopping_bag</span>
                <span class="action_name">Bag</span>
                <span class="bag-item-count">0</span>
            </div>
        </div>
    </header>
    <main>
        <div class="bag-page">
            <div class="bag-items-container">
            </div>
            <div class="bag-summary">
            </div>

        </div>
    </main>
    <footer>
        <div class="footer_container">
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
        </div>
        <hr>

        <div class="copyright">
            © 2023 www.myntra.com. All rights reserved.
        </div>
    </footer>
    <script src=" {{ asset('front-assets/clone_y/data/items.js') }}"></script>
    <script src=" {{ asset('front-assets/clone_y/scripts/index.js') }}"></script>
    <script src=" {{ asset('front-assets/clone_y/scripts/bag.js') }}"></script>
</body>

</html>
