@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user();
    @endphp
    <div class="container">
        <div class="row bg-light py-4 px-4 mt-3">
            <div class="col-12 text-end">
                <!-- Edit Profile Button -->
                <a href="{{ route('account.profileEdit') }}" class="btn btn-sm btn-outline-dark">Edit Profile</a>
            </div>
            <div class="col-12 col-md-3 pb-3 align-start">
                <!-- Profile Image -->
                <img src="{{ asset('front-assets/images/PersonImage.png') }}" alt="Profile Image"
                    class="img-fluid w-100 mx-auto d-block">
            </div>
        </div>
        

        <div class="col-12 bg-white py-4 px-4 mt-3">
            <table class="dashboard-squareContainer w-100">
                <tbody>
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="#">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/profile-orders.png')}}"
                                        alt="Orders">
                                    <p class="mt-2 mb-0 text-dark"><strong>Orders</strong></p>
                                    <p class="text-muted">Check your order status</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="/my/savedvpa">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/upiIcon.png')}}"
                                        alt="Saved UPI">
                                    <p class="mt-2 mb-0 text-dark"><strong>Saved UPI</strong></p>
                                    <p class="text-muted">View your saved UPI</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="/my/profile/edit">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/profile-edit.png')}}"
                                        alt="Profile Details">
                                    <p class="mt-2 mb-0 text-dark"><strong>Profile Details</strong></p>
                                    <p class="text-muted">Change profile details</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="#">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/profile-myntra-credit.png')}}"
                                        alt="Myntra Credit">
                                    <p class="mt-2 mb-0 text-dark"><strong>Myntra Credit</strong></p>
                                    <p class="text-muted">Manage all your refunds & gift cards</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="/my/savedcards">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/profile-cards.png')}}"
                                        alt="Saved Cards">
                                    <p class="mt-2 mb-0 text-dark"><strong>Saved Cards</strong></p>
                                    <p class="text-muted">Save your cards for faster checkout</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="/my/savedwalletsbnpl">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/wallets_bnpl.png')}}"
                                        alt="Wallets/BNPL">
                                    <p class="mt-2 mb-0 text-dark"><strong>Wallets/BNPL</strong></p>
                                    <p class="text-muted">View your saved Wallets and BNPL</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="/my/address">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/profile-address.png')}}"
                                        alt="Addresses">
                                    <p class="mt-2 mb-0 text-dark"><strong>Addresses</strong></p>
                                    <p class="text-muted">Save addresses for a hassle-free checkout</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="/my/coupons">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/profile-coupons.png')}}"
                                        alt="Coupons">
                                    <p class="mt-2 mb-0 text-dark"><strong>Coupons</strong></p>
                                    <p class="text-muted">Manage coupons for additional discounts</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="#">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/profile-collections.png')}}"
                                        alt="Collection & Wishlist">
                                    <p class="mt-2 mb-0 text-dark"><strong>Collection & Wishlist</strong></p>
                                    <p class="text-muted">All your curated product collections</p>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 mt-4 ">
                            <div class="card card-hover p-4 text-center">
                                <a href="/my/myntrapoints">
                                    <img class="w-25 mx-auto"
                                        src="{{asset('myProfile/profile-myntrapoints.png')}}"
                                        alt="MynCash">
                                    <p class="mt-2 mb-0 text-dark"><strong>MynCash</strong></p>
                                    <p class="text-muted">Earn MynCash as you shop and use them in checkout</p>
                                </a>
                            </div>
                        </div>
                        <tr>
                </tbody>
            </table>

            <div class="row">
                <div class="col-12 pt-5 text-center">
                    <a href="{{ route('account.logout') }}" class="btn btn-danger w-100">LOG OUT</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-hover {
            transition: background-color 0.3s ease;
            /* Smooth transition effect */
        }

        .card-hover:hover {
            background-color: #f8f9fa;
            /* Bootstrap bg-light color */
        }
    </style>
@endsection
