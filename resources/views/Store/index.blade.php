@extends('layouts.app')

@section('title', 'Página Inicial da Loja')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
@endpush

@section('content')
    <div class="test">
        <h1>Bem-vindo à Loja</h1>
        <p>Explore nossos produtos e categorias.</p>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/index.js') }}"></script>
@endpush