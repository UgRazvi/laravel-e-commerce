@extends('admin.layouts.app')
@section('dyn-content')
<div class="container mt-5 mb-4">
    @include('admin.message')
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Card Component -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">Role : {{$role->name}}
                        <a href="{{ route('roles.index') }}" class="btn btn-outline-light btn-sm float-end">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </h4>
                </div>
                <div class="card-body bg-light">
                    @if(!empty($role))
                    {{-- @dd($role); --}}
                    <form action="{{ route('roles.updatePermissionsToRole', $role->id) }}" method="POST" class="RoleRoleForm" id="RoleRoleForm">
                        @csrf
                        @method('PUT')
                    
                        <div class="mb-4">
                            <label for="role_permissions" class="form-label h6 text-muted">Permissions</label>
                            <div class="row justify-content-center align-items-center">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" 
                                                   value="{{ $permission->name }}" class="form-check-input @error('permissions') is-invalid @enderror" {{in_array($permission->id, $rolePermissions) ? 'checked' : ''}}>
                                            <label for="permission_{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    
                        <div class="mb-4 text-center">
                            <button type="submit" class="btn btn-dark btn-lg w-100">Update Role</button>
                        </div>
                    </form>
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection