@extends('admin.layouts.app')

@section('dyn-content')

    <div class="container">
        <div class="pb-0 card-header bg-dark text-white">
            <h4 class="d-flex justify-content-between align-items-center">
                <span>Theme List</span>
                {{-- @can('Create Roles') --}}
                            <a href="{{ route('themes.create') }}" class="btn btn-light ">Create New Theme</a>

                {{-- @endcan --}}
            </h4>
        </div>
        {{-- <h1>Themes List</h1>
        <a href="{{ route('themes.create') }}" class="btn btn-primary mb-3">Create New Theme</a> --}}
        <table class="my-5 px-2 table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($theme_instance as $theme)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $theme->key }}</td>
                        <td>
                            @if($theme->type == 'color')
                                <span style="background-color: {{ $theme->value }}; padding: 5px;">Color</span>
                            @elseif($theme->type === 'logo')
                            {{-- @dd("HELLO", $theme->value) --}}
                                <img src="{{ asset('uploads/Themes/'.$theme->value) }}" alt="Logo" style="width: 50px; height: 50px;">
                            @else
                                {{ $theme->value }}
                            @endif
                        </td>
                        <td>{{ ucfirst($theme->type) }}</td>
                        <td>
                            <a href="{{ route('themes.edit', $theme->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('themes.destroy', $theme->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endsection
@section('customJs')
    
@endsection
