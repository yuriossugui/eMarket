@extends('adminlte::page')

@section('title', 'Cliente')

  @section('content')

    <h1>Novo Cliente</h1>
    
    <form method="post" action="/clientes">
        @CSRF
        
        <div class="mb-3">
            <label for="nome" class="form-label">Informe o nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" required="">
        </div>
    
        <div class="mb-3">
            <label for="email" class="form-label">Informe o email:</label>
            <input type="email" id="email" name="email" class="form-control" rows="4" required="">
        </div>
    
        <div class="mb-3">
            <label for="telefone" class="form-label">Informe o telefone:</label>
            <input type="number" id="telefone" name="telefone" class="form-control" required="">
        </div>
    
    
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
   

  @endsection
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>