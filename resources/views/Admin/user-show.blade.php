@extends('adminlte::page')

@section('title', 'Editar Usuário')

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
                    <h3 class="mb-0 font-weight-bold"><i class="fas fa-edit mr-2"></i> Editar Usuário #{{ $user->id }}</h3>
                </div>

                <div class="card-body p-4">
                    <form action="/admin/user-update/{{$user->id}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label text-muted"><i class="fas fa-tag mr-2"></i> Nome</label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ $user->name }}" placeholder="Digite o nome do usuario" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label text-muted"><i class="fas fa-at mr-2"></i> E-mail</label>
                            <input type="text" class="form-control form-control-lg" name="email" id="email" value="{{ $user->email }}" placeholder="Digite o e-mail do usuário">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label text-muted"><i class="fas fa-user-tag mr-2"></i> Permissão</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="user">Usuário</option>
                                <option value="admin">Administrador</option>
                            </select>       
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg btn-success rounded-pill shadow-sm">
                                <i class="fas fa-save mr-2"></i> Atualizar Usuário
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