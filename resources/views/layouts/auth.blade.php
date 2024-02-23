@extends('layouts.main')

@section('main_content')

    <x-card>
        @yield('auth.content')
    </x-card>

@endsection