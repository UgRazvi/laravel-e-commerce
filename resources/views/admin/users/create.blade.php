@extends('admin.layouts.app')

@section('dyn-content')
    
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create User</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ route('users.store') }}" method="POST">
    @csrf
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">					
                    <div class="row">
                        <!-- User Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        
                        <!-- Mobile No -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone">Mobile No</label>
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No">
                            </div>
                        </div>

                        <!-- Birthday -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="birthday">Birthday</label>
                                <input type="date" name="birthday" id="birthday" class="form-control">
                            </div>
                        </div>
                        
                        <!-- Gender -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="2">Admin</option>
                                    <option value="1">User</option>
                                </select>
                            </div>
                        </div>   

                        <!-- Password -->
                        <div class="col-md-6">
                            <div class="mb-3 position-relative">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                <i class="toggle-password-eye" id="toggle-password-eye" style="position: absolute; top: 35px; right: 15px; cursor: pointer;">
                                    <!-- Eye Icon for Hidden Password -->
                                    <svg id="eye-hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12l-3 3-3-3M12 12l3-3 3 3" />
                                    </svg>
                                    <!-- Eye Icon for Visible Password -->
                                    <svg id="eye-visible" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6" style="display:none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3C8.13 3 5 5.99 5 9c0 1.74.73 3.25 1.88 4.27l-1.25 1.25a8.034 8.034 0 010-11.06L12 3zm0 0l5.42 5.42c.47.47.82 1.03 1.08 1.62l-1.18 1.18a2.8 2.8 0 00-.57-.64l1.25-1.25a6.96 6.96 0 00-6.13-5.97z"/>
                                    </svg>
                                </i>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-6">
                            <div class="mb-3 position-relative">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                <i class="toggle-password-eye" id="toggle-password-confirmation-eye" style="position: absolute; top: 35px; right: 15px; cursor: pointer;">
                                    <!-- Eye Icon for Hidden Confirm Password -->
                                    <svg id="eye-confirmation-hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12l-3 3-3-3M12 12l3-3 3 3" />
                                    </svg>
                                    <!-- Eye Icon for Visible Confirm Password -->
                                    <svg id="eye-confirmation-visible" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6" style="display:none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3C8.13 3 5 5.99 5 9c0 1.74.73 3.25 1.88 4.27l-1.25 1.25a8.034 8.034 0 010-11.06L12 3zm0 0l5.42 5.42c.47.47.82 1.03 1.08 1.62l-1.18 1.18a2.8 2.8 0 00-.57-.64l1.25-1.25a6.96 6.96 0 00-6.13-5.97z"/>
                                    </svg>
                                </i>
                            </div>
                        </div>

                        
                        {{-- User Image --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <input type="hidden" name="image_id" value="" id="image_id">
                                <label for="image">Image</label>
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>							
            </div>
            <!-- Submit Button -->
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('users.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
    </form>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection


@section('customJs')
<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener("DOMContentLoaded", function () {
        // Show an alert that the DOM is ready
        // alert("DOM Loaded");

        // Toggle password visibility function
        function togglePasswordVisibility(inputId, iconVisibleId, iconHiddenId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIconVisible = document.getElementById(iconVisibleId);
            const eyeIconHidden = document.getElementById(iconHiddenId);
            
            if (passwordInput && eyeIconVisible && eyeIconHidden) {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';  // Show the password
                    eyeIconVisible.style.display = 'block';
                    eyeIconHidden.style.display = 'none';
                } else {
                    passwordInput.type = 'password';  // Hide the password
                    eyeIconVisible.style.display = 'none';
                    eyeIconHidden.style.display = 'block';
                }
            }
        }

        // Attach event listeners to toggle visibility if the elements exist
        const togglePasswordEye = document.getElementById('toggle-password-eye');
        const togglePasswordConfirmationEye = document.getElementById('toggle-password-confirmation-eye');

        if (togglePasswordEye) {
            togglePasswordEye.addEventListener('click', function () {
                togglePasswordVisibility('password', 'eye-visible', 'eye-hidden');
            });
        }

        if (togglePasswordConfirmationEye) {
            togglePasswordConfirmationEye.addEventListener('click', function () {
                togglePasswordVisibility('password_confirmation', 'eye-confirmation-visible', 'eye-confirmation-hidden');
            });
        }
    });

    // Dropzone
        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url: "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                console.log(response)
            }
        });
</script>

@endsection