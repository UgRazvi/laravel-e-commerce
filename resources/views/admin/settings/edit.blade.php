@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Button Color Settings</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="button_color" class="form-label">Button Color</label>
                <input type="color" name="button_color" id="button_color" class="form-control" value="{{ $buttonColor }}">
            </div>

            <div class="mb-3">
                <label for="outline_color" class="form-label">Outline Button Color</label>
                <input type="color" name="outline_color" id="outline_color" class="form-control" value="{{ $outlineColor }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Settings</button>
        </form>
    </div>
@endsection
