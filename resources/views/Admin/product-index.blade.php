@extends('adminlte::page')

@section('title', 'Produto')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/product-index.js') }}"></script>
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
                Cadastrar Produto
            </button>
            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#createCategoryForm">
                Cadastrar Categoria
            </button>
        </div>
    
        <table class="table text-center table-bordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Categoria</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->description}}</td>
                        <td>{{$p->stock}}</td>
                        <td>{{$p->price}}</td>
                        <td><img src="{{ asset('img/productImages/'.$p->image) }}" alt="" style="width:60px;height:60px"></td>
                        <td>{{$p->category->name}}</td>
                        <td><a class="btn" href="product-show/{{$p->id}}"><i class="fas fa-pen"></i></a></td>
                        <td>
                            <form action="/admin/product-destroy" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$p->id}}">
                                <button type="submit" class="btn"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>       
                @endforeach
            </tbody>
        </table>
    
        {{ $products->links('pagination::bootstrap-5') }}
    
    <!-- Modal de Cadastro de Produto -->
    <div class="modal fade" id="createProductForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-sm">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Produto</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="{{ route('create.product') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="name">Nome do Produto</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Digite o nome do produto" required>
                </div>
                <div class="form-group col-md-6">
                <label for="price">Preço</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">R$</span>
                    </div>
                    <input type="number" name="price" id="price" class="form-control" placeholder="0,00" step="0.01" required>
                </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Descreva o produto..." required></textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select name="category_id" id="category_id" class="form-control" required>
                <option value="" selected disabled>Selecione uma categoria</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="image">Imagem do Produto</label>
                <input type="file" name="image" id="image" class="form-control-file" accept="image/*">
            </div>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    
    <!-- Modal de Cadastro de Categoria -->
    <div class="modal fade" id="createCategoryForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm">
        <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Categoria</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="/admin/create-category" method="post">
            @csrf
            <div class="modal-body">
            <div class="form-group">
                <label for="category_name">Nome da Categoria</label>
                <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                </div>
                <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Ex: Eletrônicos" required>
                </div>
            </div>
            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-info text-white">Cadastrar</button>
            </div>
        </form>
        </div>
    </div>
    </div>


    </div>


@endsection