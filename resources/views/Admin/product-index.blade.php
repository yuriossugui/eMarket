@extends('adminlte::page')

@section('title', 'Produto')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection


@section('content')

    <div class="p-2 mb-3">
        <form action="" method="get">
            <div class="d-flex flex-row justify-content-around">
                <div class="">
                    <input class="form-control" type="text" name="" id="" placeholder="Código">
                </div>
                <div class="">
                    <input class="form-control" type="text" name="" id="" placeholder="Descrição">
                </div>
                <div class="">
                    <input class="form-control" type="text" name="" id="" placeholder="Preço">
                </div>
                <div class="">
                    <select class="form-control" name="" id="">
                        <option value="" selected>Selecione uma opção</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </div>
        </form>
    </div>

    <hr>

    <div class="d-flex justify-content-start mb-2">
        <a href="{{ route('product.create.form') }}">
            <button class="btn btn-primary">Cadastrar</button>
        </a>
    </div>

    <table class="table text-center table-bordered table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Categoria</th>
                <th>Imagem</th>
                <th>Ver</th>
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
            <th><a href=""><i class="fas fa-eye"></i></a></th>
            <th><a href=""><i class="fas fa-pen"></i></a></th>
            <th><a href=""><i class="fas fa-trash"></i></a></th>
        </tbody>
    </table>

@endsection