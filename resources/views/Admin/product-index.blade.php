@extends('adminlte::page')

@section('title', 'Product Index')

@section('content_header')
    <h1>PRODUCT INDEX</h1>
@endsection

@section('content')
    <a href="{{ route('logout') }}">Sair</a>

    <!-- checks if are authenticated -->
    @auth
        <h2>{{ auth()->user()->email }}</h2>
    @endauth

@endsection