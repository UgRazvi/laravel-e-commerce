@include('front.layouts.head')
@php
    $user = Auth::user();
@endphp

<body class="p-5 ">
    <div id="mainContent" class="container-fluid vh-100 d-flex flex-column p-0">
        <div id="mainReactContent" class="flex-grow-1 d-flex justify-content-center align-items-center">
            <div class="card mx-auto bg-dark" style="width: 350px;">
                <div class="card-header">
                    <img src="{{ asset('front-assets/images/Myntra-Insider-Hero-Image.jpg') }}" class="img-fluid"
                        alt="Myntra logo">
                    <h4 class="text-start text-warning mt-2"><strong> Hi {{ $user->name }}, </strong></h4>
                    <p class="text-start text-warning mt-2"> <strong>We're pleased to see your interest in the Insider
                            program.</strong> </p>
                    <p class="text-start text-white"> <strong>You're just a few purchases away from your goal!</strong>
                    </p>
                </div>

                <div class="card-body">
                    <!-- Goals Section -->
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <strong class="pt-4 text-white ">How To Get There</strong>
                        <div class="text-center">
                            <img src="{{ asset('front-assets/images/Myntra-Insider-Goal.png') }}" class="img-fluid"
                                alt="Goal image" style="max-width: 70px;">
                        </div>
                    </div>

                    <div class="bg-blue text-white row">
                        <div class="col-3">
                            <img src="{{ asset('front-assets/images/Myntra-Reward-Image.png') }}" alt="Reward Image"
                                class="img-fluid w-100">
                        </div>
                        <div class="col-9">
                            <div class="d-flex justify-content-between align-items-center h-100">
                                <div class="text-center">
                                    <strong>₹ 0</strong>
                                    <p class="mb-0">You've spent</p>
                                </div>
                                <div class="text-center">
                                    <strong>₹ 4000</strong>
                                    <p class="mb-0">Goal</p>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-3">
                        <div class="col-3">
                            <img src="{{ asset('front-assets/images/Myntra-Reward-Image.png') }}" alt="Reward Image"
                                class="img-fluid w-100">
                        </div>
                        <div class="col-9">
                            <div class="d-flex justify-content-between align-items-center h-100">
                                <div class="text-center">
                                    <strong> 0 / 2 </strong>
                                    <p class="mb-0">Your Orders</p>
                                </div>
                                <div class="text-center">
                                    <strong> 2 </strong>
                                    <p class="mb-0">Goal</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white row">
                        <p class="text-center text-dark p-1">
                            <span class="info-dot-icon"> &nbsp; i&nbsp; </span>
                            <span class="mx-2"> You need to <strong>shop for ₹4000 more</strong> and place <strong>2
                                    more orders</strong> to
                                reach your goals.</span>
                        </p>
                    </div>


                    <!-- Benefits Section -->
                    <h3 class="text-warning my-4"><strong>Benefits Of Joining The Program</strong></h3>
                    <div class="row text-center text-white mb-3">
                        <div class="col-12 my-2 d-flex justify-content-start">
                            <img src="{{ asset('front-assets/images/Early-Access-Sale.png') }}" class="img-fluid"
                                alt="Benefit" style="max-width: 60px;">
                            <p class="small pt-3 mx-2"> <strong> Early Access to Sales </strong></p>
                        </div>
                        <hr>
                        <div class="col-12 my-2 d-flex justify-content-start">
                            <img src="{{ asset('front-assets/images/insider-Exclusive-Rewards.png') }}"
                                class="img-fluid" alt="Exclusive Rewards" style="max-width: 60px;">
                            <p class="small pt-2 mx-2"> <strong> Insider Exclusive Rewards & Benefits </strong></p>
                        </div>
                        <hr>
                        <div class="col-12 my-2 d-flex justify-content-start">
                            <img src="{{ asset('front-assets/images/Free-Shipping.png') }}" class="img-fluid"
                                alt="Free Shipping" style="max-width: 60px;">
                            <p class="small pt-3 mx-2"> <strong> Free Shipping On All Purchases </strong></p>
                        </div>
                    </div>


                    {{-- How Does It Works Section --}}
                    <h3 class="mt-4 text-warning"><strong>how Does It Works</strong></h3>
                    <p class="text-white py-2">
                        Earn supercoins with every purchase.You can get upto 3 SperCoins for every ₹ 100 spent.
                    </p>
                    <div class="how-works-section">
                        <div class="enroll-earn-wrapper">
                            <div class="enroll-earn-container"><img
                                    src="{{ asset('front-assets/images/Insider-How-Works.png') }}" alt="tiers"></div>
                            <div class="enroll-earn-upgrade-container">
                                <div class="enroll-earn-upgrade"><img
                                        src="{{ asset('front-assets/images/Insider-How-Works-Up-Arrow.png') }}">
                                    <p class="pt-3 px-1">Shop on Myntra to Upgrade your tier</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Rewards Section --}}
                    <h3 class="mt-4 text-warning"><strong>Rewards</strong></h3>
                    <p class="text-white">Use your SuperCoins to get exciting offers.</p>
                    <div class="enroll-fashion-wrapper">
                        <div class="enroll-fashion-logo text-center">
                            <img src="{{ asset('front-assets/images/Myntra-Logo.png') }}" alt="myntra logo" class="image-fluid" id="myntra-logo">
                            <br>
                            <img src="{{ asset('front-assets/images/Insider-Logo.png') }}" alt="insider logo" class="image-fluid" id="insider-logo">
                        </div>
                        <p class="text-center">Fashion Advice | VIP Access | Extra Savings</p>
                    </div>
                </div>

                <!-- Sticky Button -->
                <div class="card-footer bg-light text-center" style="position: sticky; bottom: 0;">
                    <button class="btn btn-danger w-100">CONTINUE SHOPPING</button>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
    .info-dot-icon {
        height: 22px;
        width: 22px;
        border-radius: 50%;
        text-align: center;
        font-size: 14px;
        border: 1px solid;
    }

    .bg-blue {
        border-radius: 4px;
        background-color: #282c3f;
        margin-top: 10px;
    }

    .enroll-earn-wrapper {
        margin-right: 13px;
    }

    .enroll-earn-container {
        background: #2e3042;
        padding: 9px 9px 18px;
        position: relative;
        border-radius: 4px;
    }

    .enroll-earn-upgrade-container {
        color: #fff;
        bottom: 8px;
        position: relative;
    }

    .enroll-earn-container img {
        width: 100%;
    }

    .enroll-earn-upgrade {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        background: #3e4152;
        padding: 9px 16px 11px;
        border-radius: 4px;
        font-size: 12px;
    }

    .enroll-earn-upgrade img {
        width: 24px;
        height: 24px;
    }

    .enroll-fashion-wrapper {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        -ms-flex-align: center;
        align-items: center;
        margin-top: 20px;
    }

 
    #myntra-logo{
        width: 50px;
        margin-left: 7px;
    }
    #insider-logo{
        width: 200px;
        margin-left: 7px;
    }


    .enroll-fashion-wrapper p {
        color: #f5f5f6;
        opacity: .8;
        margin-top: 3px;
        margin-bottom: 13px;
    }
</style>

</html>
