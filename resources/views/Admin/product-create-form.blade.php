@extends('adminlte::page')

@section('title', 'Cadastro de Produto')

@section('js')
    <script src="{{ asset('js/product-create-form.js') }}"></script>
@endsection

@section('content')

<form action="" method="post">
    <div class="row mt-3 m-3">
        <div class="col-md-2">
            <label for="id" class="form-label">Código do Produto</label>
            <input type="text" class="form-control" id="id" value="" disabled required>
        </div>
        <div class="col">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="col">
            <label for="category" class="form-label">Categoria</label>
            <select type="text" class="form-control" id="category" name="category" required>
                <option value="" selected>Selecione</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="price" class="form-label">Preço</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>        
    </div>

    <div class="row mt-2 m-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea class="form-control" name="description"></textarea>
    </div>

    <div class="container mt-2 m-3">
        <!-- Input customizado para arquivos -->
        <div class="custom-file mb-3">
            <label for="" class="form-label"></label>
          <input type="file" class="custom-file-input" id="customFile" accept="image/*">
        </div>
    
        <!-- Área para exibir a imagem de pré-visualização -->
        <div id="preview" class="mb-3"></div>
    </div>
    

    <button type="submit" class="btn btn-primary m-3">Cadastrar</button>
</form>

@endsection