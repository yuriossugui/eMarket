@extends('layouts.app')

@section('title', 'Página Inicial da Loja')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar de filtros -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-light font-weight-bold">Filtros</div>
                    <div class="card-body">
                        <form id="filters-form" action="{{ route('store.index') }}" method="GET">
                            <input type="text" class="form-control mb-2" placeholder="Buscar produtos..." name="search">
                            <hr>
                            <h6 class="font-weight-bold">Categoria</h6>
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input category-filter" name="category[]" value="{{ $category->id }}" id="cat{{ $category->id }}">
                                    <label class="form-check-label" for="cat{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                            @endforeach
                            <hr>
                            <h6 class="font-weight-bold">Preço</h6>
                            <div class="form-group">
                                <input type="text" class="form-control mb-2" placeholder="Mínimo" name="min_price" id="price-min">
                                <input type="text" class="form-control" placeholder="Máximo" name="max_price" id="price-max">
                            </div>
                            <button type="submit" id="apply-filters" class="btn btn-primary btn-block">Aplicar</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Grid de produtos -->
            <div class="col-md-9">
                <div class="row" id="products-grid">
                    @forelse($products as $product)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="product-card h-100 p-2 d-flex flex-column">
                                @if($product->image)
                                    <img src="{{ asset('img/productImages/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="product-image img-fluid"
                                         width="300"
                                         height="200">
                                @else
                                    <img src="https://placehold.co/300x200"
                                         alt="Sem imagem"
                                         class="product-image img-fluid">
                                @endif
                                <div class="mt-2 flex-fill d-flex flex-column">
                                    <h5 class="product-title">{{ $product->name }}</h5>
                                    <p class="product-price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                                    <p class="product-stock">Em estoque: {{ $product->stock }}</p>
                                    <button class="btn buy-btn btn-sm mt-auto">Adicionar ao carrinho</button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">Nenhum produto encontrado.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/index.js') }}"></script>
@endpush