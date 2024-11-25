@extends('admin.layouts.app')

@section('dyn-content')
<div class="container py-4">
    <h1 class="text-center mb-4">🎨 Create New Color Palette</h1>

    <div class="card shadow-lg border-0">
        <div class="card-body p-5">
            <form action="{{ route('themeColors.store') }}" method="POST">
                @csrf

                <div class="row">
                    @foreach([
                        'primary', 'secondary', 'success', 'info', 'warning', 
                        'danger', 'light', 'dark', 'muted', 'white', 'black', 
                        'voilet', 'indigo', 'blue', 'green', 'yellow', 'red'
                    ] as $colorName)
                        <div class="col-md-6 mb-4">
                            <label for="{{ $colorName }}" class="form-label font-weight-bold">{{ ucfirst($colorName) }}</label>
                            <input type="color" 
                                   name="{{ $colorName }}" 
                                   id="{{ $colorName }}" 
                                   class="form-control form-control-color @error($colorName) is-invalid @enderror" 
                                   value="{{ old($colorName, '#ffffff') }}">
                            @error($colorName)
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="theme_color" class="form-label font-weight-bold">Theme Color</label>
                        <input type="color" 
                               name="theme_color" 
                               id="theme_color" 
                               class="form-control form-control-color @error('theme_color') is-invalid @enderror" 
                               value="{{ old('theme_color', '#ffffff') }}">
                        @error('theme_color')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="theme_color_s" class="form-label font-weight-bold">Theme Secondary</label>
                        <input type="color" 
                               name="theme_color_s" 
                               id="theme_color_s" 
                               class="form-control form-control-color @error('theme_color_s') is-invalid @enderror" 
                               value="{{ old('theme_color_s', '#ffffff') }}">
                        @error('theme_color_s')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="theme_color_f" class="form-label font-weight-bold">Theme Fallback</label>
                        <input type="color" 
                               name="theme_color_f" 
                               id="theme_color_f" 
                               class="form-control form-control-color @error('theme_color_f') is-invalid @enderror" 
                               value="{{ old('theme_color_f', '#ffffff') }}">
                        @error('theme_color_f')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5">Save Palette</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
