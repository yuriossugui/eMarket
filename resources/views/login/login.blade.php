@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
@endsection

@section('content')

<div class="centered-container">
    <div class="login-container">
        <h2 class="text-center mb-4 login-title">Login</h2>
        <form action="{{ route('login.post') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Digite seu email">
            </div>
            <div class="form-group">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="password" id="senha" placeholder="Digite sua senha">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </form>

        @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <p class="mb-1">Erro ao entrar:</p>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

@endsection