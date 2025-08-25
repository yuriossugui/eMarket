@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Meu Carrinho</h2>
    @if(count($cart) > 0)
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($products as $product)
                    @php
                        $subtotal = $product->price * $cart[$product->id];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'Sem categoria' }}</td>
                        <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                        <td>{{ $cart[$product->id] }}</td>
                        <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove', $product->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>R$ {{ number_format($total, 2, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
        <a href="{{ route('store.index') }}" class="btn btn-outline-primary">Continuar comprando</a>
    @else
        <div class="alert alert-info">Seu carrinho está vazio.</div>
        <a href="{{ route('store.index') }}" class="btn btn-outline-primary">Ir para a loja</a>
    @endif
</div>
@endsection
