@extends('adminlte::page')

@section('title', 'Produto')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection


@section('content') 

    @if(session('msgSuccess') != null )
        <div class="alert alert-success">
            {{ session('msgSuccess') }}
        </div>
    @endif

    @if(session('msgError') != null )
        <div class="alert alert-danger">
            {{ session('msgSuccess') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="d-flex justify-content-start mb-2 gap-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProductForm">
            Cadastrar Produto
        </button>
        <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#createCategoryForm">
            Cadastrar Categoria
        </button>
    </div>

    <table class="table text-center table-bordered table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Estoque</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><a href=""><i class="fas fa-pen"></i></a></th>
            <th><a href=""><i class="fas fa-trash"></i></a></th>
        </tbody>
    </table>

<!-- create product form -->
<div class="modal fade" id="createProductForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('create.product') }}" method="post">
            @csrf
            <div class="row mb-2">
                <div class="col">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="col">
                    <label for="price" class="form-label">Preço</label>
                    <input type="price" name="price" id="price" class="form-control">
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col">
                    <label for="category_id" class="form-label">Categoria</label>
                    <select name="category_id" id="category_id" class="form-control">

                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="image" class="form-label">Imagem</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
            </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- create category form -->
<div class="modal fade" id="createCategoryForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('create.category') }}" method="post">
            @csrf
            <div class="row mb-2">
                <div class="col">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
  </div>
</div>

@endsection