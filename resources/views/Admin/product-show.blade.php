@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Editar Produto #{{ $product->id }}</h3>
                </div>

                <div class="card-body">
                    <form action="/admin/product-edit/{{ $product->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Preço</label>
                            <input type="text" class="form-control" name="price" id="price" value="{{ $product->price }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea name="description" class="form-control" id="description" rows="4">{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Categoria</label>
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" @if($c->id == $product->category_id) selected @endif>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Imagem</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        @if($product->image)
                            <div class="mb-3 text-center">
                                <img src="{{ asset('img/productImages/' . $product->image) }}" alt="Imagem do Produto"
                                     class="img-thumbnail" style="width: 150px; height: 150px;">
                            </div>
                        @endif

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection