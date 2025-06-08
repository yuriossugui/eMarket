@extends('adminlte::page')

@section('title', 'Estoque')

@section('content')

@section('css')
    <!-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user.css') }}">
@endsection

<div class="d-flex justify-content-center mt-2">
    <h3>Usuários</h3>
</div>

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

    <div class="row mb-2">
        <div class="col">
            <a href="{{ route('register') }}"><button class="btn btn-primary">Cadastrar</button></a>
        </div>
    </div>

    <table class="table text-center table-bordered table-hover" id="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Permissão</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>{{$u->role}}</td>
                    <td><a class="btn btn-sm btn-warning" href="admin/user-show/{{$u->id}}"><i class="fas fa-pen"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @section('js')
        <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/user.js') }}"></script>
    @endsection

@endsection