@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white rounded-top py-3">
                    <h3 class="mb-0 font-weight-bold"><i class="fas fa-edit mr-2"></i> Editar Produto #{{ $product->id }}</h3>
                </div>

                <div class="card-body p-4">
                    <form action="/admin/product-edit/{{ $product->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label text-muted"><i class="fas fa-tag mr-2"></i> Nome do Produto</label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ $product->name }}" placeholder="Digite o nome do produto">
                        </div>

                        <div class="mb-4">
                            <label for="price" class="form-label text-muted"><i class="fas fa-dollar-sign mr-2"></i> Preço</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="text" class="form-control form-control-lg" name="price" id="price" value="{{ $product->price }}" placeholder="Digite o preço">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label text-muted"><i class="fas fa-file-alt mr-2"></i> Descrição</label>
                            <textarea name="description" class="form-control form-control-lg" id="description" rows="5" placeholder="Digite a descrição do produto">{{ $product->description }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="form-label text-muted"><i class="fas fa-folder mr-2"></i> Categoria</label>
                            <select class="form-control form-control-lg" name="category_id" id="category_id">
                                <option value="" disabled>Selecione uma categoria</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" @if($c->id == $product->category_id) selected @endif>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label text-muted"><i class="fas fa-image mr-2"></i> Imagem do Produto</label>
                            <input type="file" name="image" id="image" class="form-control form-control-lg">
                            <small class="form-text text-muted">Selecione uma nova imagem para substituir a atual, se desejar.</small>
                        </div>

                        @if($product->image)
                            <div class="mb-4 text-center">
                                <img src="{{ asset('img/productImages/' . $product->image) }}" alt="Imagem do Produto"
                                     class="img-thumbnail rounded shadow" style="max-width: 200px; max-height: 200px;">
                                <p class="mt-2 text-muted">Imagem atual</p>
                            </div>
                        @endif

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg btn-success rounded-pill shadow-sm">
                                <i class="fas fa-save mr-2"></i> Atualizar Produto
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-lg btn-secondary rounded-pill shadow-sm ml-3">
                                <i class="fas fa-arrow-left mr-2"></i> Voltar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
