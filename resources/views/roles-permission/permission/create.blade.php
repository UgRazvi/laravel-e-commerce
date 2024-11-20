@extends('admin.layouts.app')
@section('dyn-content')
<div class="container mt-5 mb-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Card Component -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">Create Permission
                        <a href="{{ route('permissions.index') }}" class="btn btn-outline-light btn-sm float-end">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </h4>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('permissions.store') }}" method="POST" class="RolePermissionForm" id="RolePermissionForm">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label h6 text-muted">Permission Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Enter permission name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="mb-4">
                            <label for="guard_name" class="form-label h6 text-muted">Guard Name</label>
                            <select name="guard_name" id="guard_name" class="form-control form-control-lg @error('guard_name') is-invalid @enderror">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        
                            @error('guard_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <div class="mb-4 text-center">
                            <button type="submit" class="btn btn-dark btn-lg w-100">Save Permission</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
