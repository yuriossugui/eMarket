@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/register.css')}}">
@endsection

@section('content')
    <div class="card">
    <h3 class="text-center mb-4">Formulário de Cadastro</h3>

    <form action="" method="post">
        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" placeholder="Digite seu nome" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
        </div>

        <div class="form-group">
            <label for="role">Perfil</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user">Usuário</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
    </form>
    </div>

@endsection
