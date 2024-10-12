@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user();
    @endphp
    <div class="card">

        <div class="head-portion mx-5 px-5 pt-5">
            <h2 class=""><strong>Profile Details</strong></h2>
            <hr>
        </div>

        <div class="body-portion text-center">

            <table class="table d-flex justify-content-center  mt-3">
                <tr>
                    <td>Full Name</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Mobile Number</td>
                    <td>{{ $user->mobile_no }}</td>
                </tr>
                <tr>
                    <td>Email ID</td>
                    <td>{{ $user->email ?? '- not added -' }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $user->gender ?? '- not added -' }}</td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td>{{ $user->dob ?? '- not added -' }}</td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td>{{ $user->location ?? '- not added -' }}</td>
                </tr>
                <tr>
                    <td>Alternate Mobile</td>
                    <td>{{ $user->alternate_mobile ?? '- not added -' }}</td>
                </tr>
                <tr>
                    <td>Hint Name</td>
                    <td>{{ $user->hint_name ?? '- not added -' }}</td>
                </tr>
            </table>
            <a href="{{route('account.profileEdit')}}">
                <button class="btn-danger w-25 mb-5">EDIT</button>
            </a>
        </div>
    </div>
@endsection
