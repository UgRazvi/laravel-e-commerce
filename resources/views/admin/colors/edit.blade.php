@extends('admin.layouts.app')

@section('dyn-content')
<div class="container">
    <h1>Edit Color Palette</h1>

    <form action="{{ route('colors.update', $color->id) }}" method="POST">
        @csrf
        @method('PUT')
        @foreach(['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'light', 'dark', 'muted', 'white', 'black'] as $colorName)
            <div class="form-group">
                <label for="{{ $colorName }}">{{ ucfirst($colorName) }}</label>
                <input type="text" name="{{ $colorName }}" id="{{ $colorName }}" class="form-control @error($colorName) is-invalid @enderror" value="{{ old($colorName, $color->$colorName) }}">
                @error($colorName)
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
