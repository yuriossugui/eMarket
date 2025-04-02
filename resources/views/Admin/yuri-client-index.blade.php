@extends('adminlte::page')

@section('title', 'Cliente')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/product-index.js') }}"></script>
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
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createClientForm">
            Cadastrar Cliente
        </button>        
    </div>

    <table class="table text-center table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->email}}</td>
                    <td>{{$c->telefone}}</td>
                    <td><a href="client-show/{{$c->id}}"><i class="fas fa-pen"></i></a></td>
                    <td><a data-client-id="{{$c->id}}"><i class="fas fa-trash"></i></a></td>
                </tr>       
            @endforeach
        </tbody>
    </table>

    {{ $clientes->links('pagination::bootstrap-5') }}

    <!-- create client form -->
    <div class="modal fade" id="createClientForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Clientes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/clientes" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-2">
                    <div class="col">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="number" name="telefone" id="telefone" class="form-control"></textarea>
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