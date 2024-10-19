@extends('front.layouts.app')
@section('content')
    <main class="bg-white">

        <div class="messages">
            @if (Session::has('success'))
                <div class="alert alert-success mb-3"> {!! Session::get('success') !!} </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger mb-3"> {{ Session::get('error') }} </div>
            @endif
        </div>
        @php
            $user = Auth::user();
        @endphp
        <div class="containere pt-5">
            <div class="row  px-5 mx-5 mb-0">
                <div class="col-lg-11 col-md-10 col-sm-12 mb-3">
                    <a href="{{ route('account.profile') }}" class="text-primary">Account</a>
                    <br>
                    <span class="text-muted">{{ $user->name }}</span>
                    <hr>
                </div>
            </div>
            <div class="row px-5 mx-5">

                <div class="col-lg-2 col-md-12 col-sm-12">
                    <ul class="mb-2 pb-5">
                        <li class="mt-2 pb-2"> <a href="{{ route('account.myDashboard') }}"
                                class="text-primary">Overview</a> </li>

                        <hr>
                        <li class="pb-3 pt-2"> <span class="text-muted">ORDERS</span> </li>
                        <li> <a href="{{route('account.myOrders')}}" class="text-primary">Orders & Returns</a> </li>
                        <hr>
                        <li class="pb-3 pt-2"> <span class="text-muted">CREDITS</span> </li>
                        <li> <a href="{{route('account.mynCoupon')}}" class="text-primary">Coupons</a> </li>
                        <li> <a href="{{route('account.mynCredit')}}" class="text-primary">Myntra Credit</a> </li>
                        <li> <a href="{{route('account.mynCash')}}" class="text-primary">Myn Cash</a> </li>
                        <hr>
                        <li class="pb-3 pt-2"> <span class="text-muted">ACCOUNT</span> </li>
                        <li> <a href="{{route('account.profile')}}" class="text-success">Profile</a> </li>
                        <li> <a href="#" class="text-primary"># Saved Cards</a> </li>
                        <li> <a href="{{route('account.myAddress')}}" class="text-primary">Addresses</a> </li>
                        <li> <a href="{{route('account.myn-insider')}}" class="text-primary">Myntra Inside</a> </li>
                        <li> <a href="{{route('account.deleteAccount')}}" class="text-primary">Delete Account</a> </li>
                        <hr>
                        <li class="pb-3 pt-2"> <span class="text-muted">LEGAL</span> </li>
                        <li> <a href="{{route('account.terms')}}" class="text-primary">Terms Of Use</a> </li>
                        <li> <a href="{{route('account.policy')}}" class="text-primary">Privacy Policy</a> </li>

                    </ul>
                </div>

                <div class="col-lg-9 col-md-12 col-sm-12">
                    @yield('profile-content')
                </div>

            </div>

        </div>
    </main>
@endsection
