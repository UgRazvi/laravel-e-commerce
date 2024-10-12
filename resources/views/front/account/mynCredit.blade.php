@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user();
    @endphp

    <div class="container">
        <div class="card shadow-sm mb-3">
            <div class="text-center py-3 border-bottom">
                <img src="https://constant.myntassets.com/mymyntra/assets/img/myntra-credit-logo.svg" alt="Myntra Credit Logo"
                    class="img-fluid" style="width: 130px;">
                <p class="text-uppercase text-muted mt-2" style="font-size: 10px; letter-spacing: 0.5px;">A quick and
                    convenient way to pay and refund</p>
            </div>
            <div class="row text-center pt-3">
                <div class="col-6 mb-3">
                    <img src="https://constant.myntassets.com/mymyntra/assets/img/instant-cashback.svg"
                        alt="Instant Checkout" class="img-fluid" style="height: 50px;">
                    <h6 class="mt-2">Instant Checkout</h6>
                    <p class="text-muted" style="font-size: 12px;">One-click, easy and fast checkout</p>
                </div>
                <div class="col-6 mb-3">
                    <img src="https://constant.myntassets.com/mymyntra/assets/img/faster-refunds.svg" alt="Faster Refunds"
                        class="img-fluid" style="height: 50px;">
                    <h6 class="mt-2">Faster Refunds</h6>
                    <p class="text-muted" style="font-size: 12px;">Get instant refunds as Myntra Credit</p>
                </div>
                <div class="col-6 mb-3">
                    <img src="https://constant.myntassets.com/mymyntra/assets/img/consolidated-money.svg"
                        alt="Consolidated Money" class="img-fluid" style="height: 50px;">
                    <h6 class="mt-2">Consolidated Money</h6>
                    <p class="text-muted" style="font-size: 12px;">Gift cards, refunds, and cashbacks in one place</p>
                </div>
                <div class="col-6 mb-3">
                    <img src="https://constant.myntassets.com/mymyntra/assets/img/mode-benifits.svg" alt="More Benefits"
                        class="img-fluid" style="height: 50px;">
                    <h6 class="mt-2">Many More Benefits</h6>
                    <p class="text-muted" style="font-size: 12px;">Benefits and offers on using Myntra Credit</p>
                </div>
            </div>
        </div>

        <div class="card mb-3 p-3">
            <div class="text-center">
                <p class="mb-2">Top-up your Myntra credit now!</p>
                <div class="fs-3">₹0.00</div>
            </div>
            <hr>
            <div class="d-flex justify-content-around align-items-center">
                <div class="text-center">
                    <p class="mb-1">For a quick checkout</p>
                    <button class="btn btn-outline-danger">Top Up</button>
                </div>
                
                <div class="border-start mx-3" style="height: 50px;"></div> <!-- Vertical bar -->
            
                <div class="text-center">
                    <p class="mb-1">Have a gift card?</p>
                    <button class="btn btn-outline-danger">Add Gift Card</button>
                </div>
            </div>
        </div>

        <div class="card mb-3 p-3">
            <h5 class="mb-0">Transaction Log</h5>
        </div>

        <div class="card mb-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-0">Credit Details</p>
                <span class="sprites-arrow sprites-mymyntraSprite"></span>
            </div>
        </div>

        <div class="card p-3">
            <h6 class="mb-4" ><strong>Please note</strong></h6>
            <li class="mx-1 my-2" >Myntra Credit can't be cancelled or transferred to another account.</li>
            <li class="mx-1 my-2" >It can't be withdrawn in the form of cash or transferred to any bank account.</li>
            <li class="mx-1 my-2" >It can't be used to purchase Gift Cards.</li>
            <li class="mx-1 my-2" >Net-banking and credit/debit cards issued in India can be used for Myntra Credit top up.</li>
            <li class="mx-1 my-2" >Credits have an expiry. Check FAQs for more details.</li>
            <div class="d-flex justify-content-between">
                <a href="#" class="link-primary">Myntra Credit T&amp;C &gt;</a>
                <a href="#" class="link-primary">Gift Card T&amp;C &gt;</a>
                <a href="#" class="link-primary">FAQs &gt;</a>
            </div>
        </div>

    </div>
@endsection
