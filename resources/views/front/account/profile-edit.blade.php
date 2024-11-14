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

                {{-- <div class="form-group mb-4">
                    <label>Gender</label>
                    <div class="d-flex">
                        <input type="hidden" name="gender" id="gender" value="{{ $user->gender }}">
                        <button type="button" class="btn btn-outline-secondary btn-block w-50 gender-btn"
                            data-gender="male" value="{{$user->gender}}">Male</button>
                        <button type="button" class="btn btn-outline-secondary btn-block w-50 gender-btn"
                            data-gender="female" value="{{$user->gender}}">Female</button>
                    </div>
                </div> --}}

                <div class="form-group mb-4">
                    <label>Gender</label>
                    <div class="d-flex">
                        <!-- Hidden input to store the selected gender -->
                        <input type="hidden" name="gender" id="gender" value="{{ $user->gender }}">
                
                        <!-- Male button -->
                        <button type="button" class="btn btn-outline-secondary btn-block w-50 gender-btn" 
                                data-gender="male" 
                                id="male-btn"
                                value="male" 
                                onclick="selectGender('male')">Male</button>
                
                        <!-- Female button -->
                        <button type="button" class="btn btn-outline-secondary btn-block w-50 gender-btn" 
                                data-gender="female" 
                                id="female-btn"
                                value="female" 
                                onclick="selectGender('female')">Female</button>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="birthday">Birthday (dd/mm/yyyy)</label>
                    <input type="date" id="birthday" name="birthday" class="form-control" maxlength="10"
                        placeholder="Enter birthday" value="{{ $user->birthday ? $user->birthday->format('Y-m-d') : '' }}">
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
        // Function to update gender selection
        function selectGender(gender) {
            // Set the value of the hidden input field
            document.getElementById('gender').value = gender;
    
            // Remove the 'selected' class from both buttons
            const buttons = document.querySelectorAll('.gender-btn');
            buttons.forEach(btn => btn.classList.remove('selected'));
    
            // Add the 'selected' class to the clicked button
            const selectedButton = document.querySelector(`#${gender}-btn`);
            selectedButton.classList.add('selected');
        }
    
        // Initial selection based on the current gender value
        document.addEventListener('DOMContentLoaded', () => {
            const selectedGender = document.getElementById('gender').value;
            selectGender(selectedGender);
        });
    </script>
    
@endsection
