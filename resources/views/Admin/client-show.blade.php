@extends('adminlte::page')

@section('title', 'Ver Cliente')

  @section('content')

  <h1>Consultar Cliente</h1>
    
    <form method="post" action="/clientes/{{ $clientes-> id }}">
        @CSRF
        @method('DELETE')
        <div class="mb-3">
            <label for="nome" class="form-label">Informe o nome:</label>
            <input type="text" id="nome" name="nome" value="{{ $clientes->nome}}" class="form-control" disabled>
        </div>
    
        <div class="mb-3">
            <label for="email" class="form-label">Informe o email:</label>
            <input type="email" id="email" name="email" value="{{ $clientes->email}}" class="form-control" rows="4" disabled>
        </div>
    
        <div class="mb-3">
            <label for="telefone" class="form-label">Informe o telefone:</label>
            <input type="number" id="telefone" name="telefone" value="{{ $clientes->telefone }}" class="form-control" disabled>
        </div>
    
        <p>Deseja excluir o registro?</p>
        <button type="submit" class="btn btn-danger">Excluir</button>
        <a href="/clientes" class="btn btn-primary">Cancelar</a>
    </form>


  @endsection