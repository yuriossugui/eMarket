@extends('adminlte::page')

@section('title', 'Gerenciar Categorias')

@section('js')

@endsection

@section('content')


    <div class="p-2 mt-2">
        <p>Cadastrar uma categoria</p>
        <div class="d-flex flex-row mb-3">
            <label for="" class="form-label">Nome:</label>
            <input class="form-control" type="text" name="name" id="">
            <button class="btn btn-primary ml-2" type="submit">Cadastrar</button>
        </div>
    </div>


    <hr>

    <div class="p-2 mb-3">
        <form action="" method="get">
            <div class="d-flex flex-row justify-content-around">
                <div class="">
                    <input class="form-control" type="text" name="" id="" placeholder="Data início">
                </div>
                <div class="">
                    <input class="form-control" type="text" name="" id="" placeholder="Data fim">
                </div>
                <div class="">
                    <input class="form-control" type="text" name="" id="" placeholder="Nome">
                </div>
                
                <button class="btn btn-primary" type="submit">Filtrar</button>
            </div>
        </form>
    </div>

@endsection