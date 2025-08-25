@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="row g-0">
                    <div class="col-md-5 d-flex align-items-center justify-content-center bg-light">
                        @if($product->image)
                            <img src="{{ asset('img/productImages/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/300x300?text=Sem+Imagem" class="img-fluid rounded" alt="Sem imagem">
                        @endif
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->name }}</h2>
                            <h5 class="text-muted mb-2">Categoria: {{ $product->category->name ?? 'Sem categoria' }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="mb-1"><strong>Preço:</strong> R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                            <p class="mb-1"><strong>Estoque disponível:</strong> {{ $product->stock }}</p>
                            <form method="" action="" class="mt-3">
                                @csrf
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantidade</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="{{ $product->stock }}" value="1" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Adicionar ao Carrinho</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('store.index') }}" class="btn btn-outline-secondary">Voltar para a loja</a>
        </div>
    </div>
</div>
@endsection
