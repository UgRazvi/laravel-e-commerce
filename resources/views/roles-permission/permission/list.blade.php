@extends('admin.layouts.app')
@section('dyn-content')
    <div class="container mt-4">
    
    @include('admin.message')
    {{-- @include('roles-permission.nav-links') --}}

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="d-flex justify-content-between align-items-center">
                    <span>Permissions</span>
                    @can('Create Permissions')
                        <a href="{{ route('permissions.create') }}" class="btn btn-light">
                            <i class="bi bi-plus-circle"></i> Add Permission
                        </a>
                    @endcan
                </h4>
            </div>
            <div class="card-body bg-light">

                
                <table class="table table-striped table-bordered table-hover dt-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            @if(auth()->user()->can('Edit Permissions') && auth()->user()->can('Delete Permissions'))

                                <th>
                                    Actions
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>

                        @if($permissions->isNotEmpty())
                            @foreach($permissions as $permission)
                            <tr class="text-center">
                                <td class="text-center">{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d/m/y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($permission->updated_at)->format('d/m/y') }}</td>
                                
                                @if(auth()->user()->can('Edit Permissions') && auth()->user()->can('Delete Permissions'))
                                <td class="text-center">
                                    @can('Edit Permissions')
                                        <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    @endcan
                                    
                                    @can('Delete Permissions')
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                                @endif
                                
                            
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center text-danger">No Data Found</td>
                        </tr>
                        @endif

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center"></td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script>
        $(document).ready(function() {
        // alert("Test 1");
        $('.table').DataTable({
                "paging": true,  // Enable pagination
                "ordering": true, // Enable sorting
                "info": true,  // Show table information
                "searching": true, // Enable search functionality
                "lengthMenu": [10, 25, 50, 100, 500, 1000] // Page length options
            });
        });

    </script>
@endsection

