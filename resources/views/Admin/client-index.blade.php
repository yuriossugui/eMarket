@extends('adminlte::page')

@section('title', 'Clientes')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('content') 

    @if(session('msgSuccess') != null )
        <div class="alert alert-success mt-2">
            {{ session('msgSuccess') }}
        </div>
    @endif

    @if(session('msgError') != null )
        <div class="alert alert-danger mt-2">
            {{ session('msgSuccess') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

    <div id="mainContainer" class="card p-2 m-2">

        <div class="d-flex justify-content-start mb-2 gap-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProductForm">
                Cadastrar Cliente
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
                
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><i class="fas fa-pen"></i></td>
                        <td>
                            <form action="/admin/product-destroy" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="">
                                <button type="submit" class="btn"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>       
                
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
                <form action="{{ route('create.product') }}" method="post" enctype="multipart/form-data">
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
                                <option value="" selected>Selecione uma opção</option>
                                
                                    <option value=""></option>
                                
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


    </div>


@endsection