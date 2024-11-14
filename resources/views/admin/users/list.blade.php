@extends('admin.layouts.app')
@section('dyn-content')
    <!-- Content Header (Page header) -->

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('users.create')}}" class="btn btn-primary">New User</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-none">
                    <div class="card-tools">
                        <div class="input-group input-group " style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive m-2">								
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="d-none">IMAGE</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Gender</th>
                                <th>Role</th>
                                <th>Birth Day</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($users))
                            @foreach ($users as $user)
                            {{-- @dd($user); --}}
                            <tr class="text-center">
                                <td>
                                    {{$user->id}}
                                </td>
                                <td class="d-none">
                                    @if (!empty($user->image))
                                        <img src="{{ asset('uploads/Users/' . $user->id . '.jpeg') }}" class="img-thumbnail" width="50" alt="User Image">
                                    @else
                                        <img src="{{ asset('admin-assets/img/avatar5.png') }}" class="img-thumbnail" width="50" alt="Dummy Image">
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->mobile_no}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{ ($user->role == 2) ? 'Admin' : 'User' }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->birthday)->format('M j, y') }}</td>

                                <td>
                                    @if ($user->status == 1)
                                    <svg class="text-success-500 h-6 w-6 text-success"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @else
                                        <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    @endif

                                </td>
                                <td>
                                   <!-- Edit Button -->
                                <a href="{{ route('users.edit', $user->id) }}" class="text-primary">
                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" style="border: none; background: none;">
                                        <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </form>

                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>										
                </div>
            
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                // "order": [
                //     [0, 'asc']
                // ],
                "paging": true, // Enable pagination
                "ordering": true, // Enable sorting
                "info": true, // Show table info
                "searching": true, // Enable search
                "lengthMenu": [25, 50, 100, 500, 1000] // Page length options
            });
        });
    </script>
@endsection
