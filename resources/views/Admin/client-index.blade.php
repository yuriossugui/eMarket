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
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Número de celular</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $c)
                <tr>
                    <td>{{$c->name}}</td>
                    <td>{{$c->email}}</td>
                    <td>{{$c->phone_number}}</td>
                    <td><a href="/admin/client-show/{{$c->id}}"><button class="btn"><i class="fas fa-pen"></i></button></a></td>
                    <td>
                        <form action="/admin/client-destroy" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$c->id}}">
                            <button type="submit" class="btn"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach            
            </tbody>
        </table>
    
    
        <!-- create product form -->
        <div class="modal fade" id="createProductForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create.client') }}" method="post">
                    @csrf
                    <div class="row mb-2">

                        <div class="col">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                    </div>
    
                    <div class="row mb-2">
                        <div class="col">
                            <label for="phone_number" class="form-label">Número do Celular</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control"></textarea>
                        </div>

                        <div class="col">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" name="password" id="password" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="row mb-2">

                        <div class="col">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control">
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