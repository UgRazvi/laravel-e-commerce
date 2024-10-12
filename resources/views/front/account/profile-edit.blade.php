@extends('front.account.profileLayout')
@section('profile-content')
    @php
        $user = Auth::user();
    @endphp

    <div class="card">
        <div class="container">
            <div class="text-start mx-5 px-5 pt-5 ">
                <h4><strong>Edit Details</strong></h4>
            </div>
            <hr>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('account.profileUpdate') }}" method="POST" autocomplete="off" class="px-5">
                @csrf
                @method('PUT')

                <div class="form-group mt-4 mb-4">
                    <label for="mobile-number">Mobile Number</label>
                    <div class="input-group">
                        <input type="text" id="mobile-number" name="mobile_no" class="form-control"
                            value="{{ $user->mobile_no }}" placeholder="Enter Mobile Number" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" type="button">Change</button>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="full-name">Full Name</label>
                    <input type="text" id="full-name" name="name" class="form-control" value="{{ $user->name }}"
                        maxlength="50" placeholder="Enter Full Name" required>
                </div>

                <div class="form-group mb-4">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter email"
                        value="{{ $user->email }}" required>
                </div>

                <div class="form-group mb-4">
                    <label>Gender</label>
                    <div class="d-flex">
                        <button type="button" class="btn btn-outline-secondary btn-block w-50 gender-btn"
                            data-gender="male">Male</button>
                        <button type="button" class="btn btn-outline-secondary btn-block w-50 gender-btn"
                            data-gender="female">Female</button>
                    </div>
                    <input type="hidden" name="gender" id="gender" value="{{ $user->gender }}">
                </div>

                <div class="form-group mb-4">
                    <label for="birthday">Birthday (dd/mm/yyyy)</label>
                    <input type="text" id="birthday" name="birthday" class="form-control" maxlength="10"
                        placeholder="Enter birthday" value="{{ $user->birthday ? $user->birthday->format('d/m/Y') : '' }}">
                </div>

                <div class="form-group mb-4">
                    <label for="alt-mobile">Alternate Mobile Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+91</span>
                        </div>
                        <input type="tel" id="alt-mobile" name="alternate_mobile_no" class="form-control" maxlength="10"
                            placeholder="Enter alternate mobile number" value="{{ $user->alternate_mobile_no }}">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="hint-name">Hint Name</label>
                    <input type="text" id="hint-name" name="hint_name" class="form-control" placeholder="Enter hint name"
                        value="{{ $user->hint_name }}">
                </div>

                <div class="form-group text-center mt-5 mb-5">
                    <button type="submit" class="btn btn-danger w-100">Save Details</button>
                </div>
            </form>

        </div>
    </div>

    <style>
        .gender-btn {
            position: relative;
        }

        .gender-btn.selected::after {
            content: '✔';
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('.gender-btn').on('click', function() {
                $('.gender-btn').removeClass('selected');
                $(this).addClass('selected');
                $('#gender').val($(this).data('gender')); // Set the hidden input value
            });
        });
    </script>
@endsection
