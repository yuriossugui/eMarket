@extends('adminlte::page')

@section('title', 'Categorias')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/category-index.css') }}">
@endsection

@section('content') 

    @if(session('msgSuccess') != null )
        <div class="alert alert-success mt-2">
            {{ session('msgSuccess') }}
        </div>
    @endif

    @if(session('msgError') != null )
        <div class="alert alert-danger mt-2">
            {{ session('msgError') }}
        </div>
    @endif

    <div id="mainContainer" class="card p-2 m-2">
    
        <table class="table text-center table-bordered table-hover" id="mainTable">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nome URL</th>
                    <th>Data do Cadastro</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $c)
                <tr>
                    <td>{{$c->name}}</td>
                    <td>{{$c->slug}}</td>
                    <td>{{$c->created_at}}</td>
                    <td><a class="btn btn-sm btn-warning" href="/admin/category-show/{{$c->id}}"><i class="fas fa-pen"></i></a></td>
                    <td>
                        <form action="/admin/category-delete" method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria ?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$c->id}}">
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach            
            </tbody>
        </table>

    </div>

    @section('js')
        <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/category-index.js') }}"></script>
    @endsection

@endsection