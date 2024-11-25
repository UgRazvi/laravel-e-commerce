@extends('admin.layouts.app')

@section('dyn-content')
<div class="container">
    hello
    <a href="{{route('themeColors.create')}}">CREATE</a>
    {{-- <a href="{{route('themeColors.edit')}}">CREATE</a> --}}
    {{-- @dd($colors); --}}
    @foreach ($colors as $color)
    {{$loop->iteration}}
        {{-- <label for="{{$color->id}}">{{$color->name}}</label> --}}
    @endforeach

</div>
@endsection
