@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content')

    <div class="d-flex justify-content-center align-items-center" style="height: 600px;">
        <div class="card p-2">
            <div class="card-header mb-2">
                <h2>Cliente #{{$clientes->id}}</h2>
            </div>
            <form action="/clientes/{{$clientes->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-2">
                    <div class="col">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="{{$clientes->nome}}">
                    </div>
                    <div class="col">
                        <label for="name">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{$clientes->email}}">
                    </div>
                    <div class="col">
                        <label for="name">Telefone</label>
                        <input type="number" class="form-control" name="telefone" id="telefone" value="{{$clientes->telefone}}">
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </div>

@endsection