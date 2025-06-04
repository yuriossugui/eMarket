@extends('adminlte::page')

@section('title', 'Estoque')

@section('content')

@section('css')
    <!-- <link rel="stylesheet" href="{{ asset('css/main.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/storage.css') }}">
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

    <table class="table text-center table-bordered table-hover" id="table">
        <thead>
            <tr>
                <th>Código do Produto</th>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
                <th>Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->name}}</td>
                    <td>{{$p->stock}}</td>
                    <td>{{$p->stock * $p->price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @section('js')
        <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/storage.js') }}"></script>
    @endsection

@endsection