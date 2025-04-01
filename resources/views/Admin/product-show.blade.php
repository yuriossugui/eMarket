@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content')

    <div class="d-flex justify-content-center align-items-center" style="height: 600px;">
        <div class="card p-2">
            <div class="card-header mb-2">
                <h2>Produto #{{$product->id}}</h2>
            </div>
            <form action="/admin/product-edit/{{$product->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-2">
                    <div class="col">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$product->name}}">
                    </div>
                    <div class="col">
                        <label for="name">Preço</label>
                        <input type="text" class="form-control" name="price" id="price" value="{{$product->price}}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="description">Descrição</label>
                        <textarea name="description" class="form-control" id="description" value="">{{$product->description}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="" for="category_id">Categoria</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach($categories as $c)
                                <option value="{{$c->id}}" @if($c->id == $product->category_id) selected @endif>{{$c->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="image">Imagem</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                    <div class="d-flex justify-content-center mt-2">
                        <img src="{{asset('img/productImages/'.$product->image)}}" alt="" style="width:100px;height:100px;">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </div>

@endsection