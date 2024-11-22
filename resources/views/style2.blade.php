

<style>
    @media (max-width: 768px) {
        .navbar {
            flex-direction:
                column;
        }
    }

    .carousel-base {
        -webkit-box-sizing:
            border-box;
        box-sizing:
            border-box;
        padding-top:
            20px;
        padding-bottom:
            15px;
        margin:
            0 auto;
    }

    .container-base {
        -webkit-box-sizing:
            border-box;
        box-sizing:
            border-box;
        width:
            100%;
        position:
            relative;
        overflow:
            hidden;
        background-repeat:
            no-repeat;
    }

    footer {
        height:
            55px;
        background-color:
            #f7f7f7;
        padding-top:
            28px;
        font-size:
            14px;
        color:
            #696b79;
        text-decoration:
            none;
        font-family:
            Whitney,
            -apple-system,
            BlinkMacSystemFont,
            Segoe UI,
            Roboto,
            Helvetica,
            Arial,
            sans-serif;
        -webkit-font-smoothing:
            antialiased;
        -webkit-text-size-adjust:
            100%;
        letter-spacing:
            0.3px;
    }

    footer a {
        cursor:
            pointer;
        color:
            #696b79;
        text-decoration:
            none;
        font-weight:
            500;
    }

    .footer-container {
        display:
            flex;
        flex-direction:
            column;
        background-color:
            #f7f7f7;
        padding-left:
            100px;
        padding-right:
            80px;
        width:
            100%;
    }

    .row {
        display:
            flex;
        margin-bottom:
            20px;
    }

    .online-shopping {
        text-align:
            left;
        margin-right:
            50px;
    }

    .customer-policies {
        text-align:
            left;
        margin-right:
            50px;
    }

    .app {
        text-align:
            left;
        margin-right:
            90px;
    }

    .customer-surity {
        display:
            flex;
        flex-direction:
            column;
        justify-content:
            flex-start;
        align-items:
            flex-start;
        text-align:
            left;
    }

    .content-heading {
        color:
            black;
        font-weight:
            600;
        letter-spacing:
            normal;
    }

    .content-box {
        line-height:
            1.6;
    }

    .para-content {
        margin-top:
            25px;
        margin-bottom:
            40px;
    }

    .copyright-container {
        display:
            flex;
        justify-content:
            space-between;
        margin-bottom:
            30px;
    }

    .horizontal-line {
        margin-bottom:
            30px;
        opacity:
            0.2;
        height:
            0.3px;
    }

    .office-address-content {
        opacity:
            0.9;
        margin-bottom:
            30px;
    }

    .other-info-heading {
        font-weight:
            600;
        letter-spacing:
            normal;
        color:
            black;
        font-size:
            15px;
        opacity:
            0.8;
    }

    .other-info-para-content {
        margin-top:
            8px;
        margin-bottom:
            30px;
        font-size:
            13px;
        opacity:
            0.8;
    }

    .Google-play {
        background-repeat:
            none;
        margin-right:
            10px;
    }

    .App-Store {
        background-repeat:
            none;
    }

    .download-button {
        display:
            flex;
        margin-top:
            30px;
    }

    .download-button img {
        width:
            130px;
        height:
            40px;
    }

    .original {
        margin-bottom:
            30px;
        color:
            black;
        opacity:
            0.8;
    }

    .footer-item {
        display:
            flex;
        align-items:
            center;
        margin-bottom:
            10px;
    }

    .footer-item img {
        margin-right:
            10px;
    }

    .social-links {
        margin-top:
            12px;
    }

    .fb-icon {
        margin-right:
            6px;
    }

    .tw-icon {
        margin-right:
            6px;
    }

    .yt-icon {
        margin-right:
            6px;
    }

    .section7 img {
        cursor:
            pointer;
        width:
            100%;
        background-size:
            cover;
    }

    .section8 {
        display:
            flex;
        justify-content:
            center;
    }


    /* Custom Styles */
    body {
        background-color: #f9f9f9;
    }


    .bg-light-gray {
        background-color: #f6f6f6;
    }

    .cart-progress .step {
        font-weight: bold;
        color: #333;
    }

    .cart-progress .divider {
        color: #888;
    }

    .cart-table img {
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .cart-table td {
        padding: 1rem;
    }

    .form-select {
        max-width: 120px;
    }

    .btn-minus,
    .btn-plus {
        padding: 0.3rem 0.6rem;
    }

    .cart-summery .card {
        border-color: #ddd;
        background-color: #fff;
    }

    .breadcrumb {
        background-color: #fff;
    }

    .breadcrumb-item a {
        color: #007bff;
    }

    .btn-outline-dark {
        color: #333;
        border-color: #ddd;
    }

    .btn-danger {
        background-color: <?php echo getDanger(); ?>;
        border-color: <?php echo getDanger(); ?>;
    }

    .btn-outline-danger {
        color: <?php echo getDanger(); ?>;
        border-color: <?php echo getDanger(); ?>;
    }

    .btn-danger:hover,
    .btn-outline-danger:hover {
        background-color: <?php echo getDanger(); ?>;
        color: #fff;
    }

    .quantity .btn {
        padding: 2px 8px;
        font-size: 12px;
        width: 30px;
        /* Adjust as per requirement */
    }

    .quantity .form-control {
        width: 50px;
        /* Adjust to fit the smaller input */
        font-size: 12px;
        padding: 2px;
    }

    .rounded {
        border-radius: 20%;
    }
</style>