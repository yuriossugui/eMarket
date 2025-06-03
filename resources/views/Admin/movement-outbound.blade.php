@extends('adminlte::page')

@section('title', 'Saída de Produto')

@section('content')

@section('css')
    <!-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/movement-outbound.css') }}">
@endsection

<div class="d-flex justify-content-center mt-2">
    <h3>Histórico de saída de produtos</h3>
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

    <div class="d-flex justify-content-start mb-2 gap-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProductForm">
            Registrar Saída
        </button>
    </div>

    <table class="table text-center table-bordered table-hover" id="table">
        <thead>
            <tr>
                <th>Código do Produto</th>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
                <th>Data da Movimentação</th>
                <th>Autor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($outputs as $o)
                <tr>
                    <td>{{$o->product->id}}</td>
                    <td>{{$o->product->name}}</td>
                    <td>{{$o->quantity}}</td>
                    <td>{{$o->created_at}}</td>
                    <td>{{$o->user->name}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
    <div class="modal fade" id="createProductForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar saída</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="/admin/register-output" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="product_id">Produto</label>
                                <select class="form-control" name="product_id" id="product_id" required>
                                    <option value="" selected>Selecione um produto</option>
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="quantity">Quantidade</label>
                                <div class="input-group">                   
                                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="0" step="1" required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('js')
        <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/movement-outbound.js') }}"></script>
    @endsection

@endsection