@extends('adminlte::page')

@section('title', 'Editar Categoria')

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
    
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white rounded-top py-3">
                    <h3 class="mb-0 font-weight-bold"><i class="fas fa-edit mr-2"></i> Editar Categoria #{{ $category->id }}</h3>
                </div>

                <div class="card-body p-4">
                    <form action="/admin/category-update/{{$category->id}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label text-muted"><i class="fas fa-tag mr-2"></i> Nome</label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ $category->name }}" placeholder="Digite o nome da categoria">
                        </div>

                        <div class="mb-4">
                            <label for="slug" class="form-label text-muted"><i class="fas fa-at mr-2"></i> Nome URL</label>
                            <input type="text" class="form-control form-control-lg" name="slug" id="slug" value="{{ $category->slug }}" placeholder="Digite o nome que será exibido na URL">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg btn-success rounded-pill shadow-sm">
                                <i class="fas fa-save mr-2"></i> Atualizar Categoria
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-lg btn-secondary rounded-pill shadow-sm ml-3">
                                <i class="fas fa-arrow-left mr-2"></i> Voltar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection