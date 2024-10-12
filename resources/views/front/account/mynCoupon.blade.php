@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user();
    @endphp
@endsection
