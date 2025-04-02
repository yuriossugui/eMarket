@extends('layout')

@section('title', 'Cliente')

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="container">

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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>