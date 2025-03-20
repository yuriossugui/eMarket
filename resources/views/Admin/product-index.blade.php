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
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Cadastrar
        </button>
    </div>

    <table class="table text-center table-bordered table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('')}}" method="post">

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