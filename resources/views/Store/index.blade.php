@extends('layouts.app')

@section('title', 'Página Inicial da Loja')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
@endpush

@section('content')
    <div class="row">
        @forelse($products as $product)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('img/productImages/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=Sem+Imagem " class="card-img-top" alt="Sem imagem">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                        <div class="mt-auto">
                            <p class="font-weight-bold">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                            <p class="text-success">Em estoque: {{ $product->stock }}</p>
                            <a href="#" class="btn btn-primary btn-block">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Nenhum produto encontrado.</div>
            </div>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/index.js') }}"></script>
@endpush