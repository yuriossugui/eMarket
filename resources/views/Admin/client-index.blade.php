@extends('adminlte::page')

@section('title', 'Ver Clientes')


    @section('content')

        <h1>Clientes</h1>

        <a class="btn btn-primary mb-3" href="/clientes/create">Novo Cliente</a>

        @if (session('erro'))
        <div class="alert alert-danger">
            {{ session('erro')}}
        </div>
        @endif

        @if (session('sucesso'))
        <div class="alert alert-success">
            {{ session('sucesso')}}
        </div>
        @endif

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $c)
                <tr>
                    <td> {{ $c->id }}</td>
                    <td> {{ $c->nome }}</td>
                    <td> {{ $c->email }}</td>
                    <td>
                        <a href="/clientes/{{ $c->id }}/edit" class="btn btn-warning">Editar</a>
                        <a href="/clientes/{{ $c->id }}" class="btn btn-info">Consultar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    @endsection