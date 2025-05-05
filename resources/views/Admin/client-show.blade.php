@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-gradient-primary text-white rounded-top py-3">
                    <h3 class="mb-0 font-weight-bold"><i class="fas fa-edit mr-2"></i> Editar Cliente #{{ $client->id }}</h3>
                </div>

                <div class="card-body p-4">
                    <form action="/admin/client-update/{{$client->id}}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label text-muted"><i class="fas fa-tag mr-2"></i> Nome</label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ $client->name }}" placeholder="Digite o nome do produto">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label text-muted"><i class="fas fa-at mr-2"></i> E-mail</label>
                            <input type="text" class="form-control form-control-lg" name="email" id="email" value="{{ $client->email }}" placeholder="Digite o e-mail do cliente">
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="cpf_numbers" class="form-label text-muted"><i class="fas fa-id-card mr-2"></i> CPF</label>
                                <input type="text" class="form-control form-control-lg" name="cpf_numbers" id="cpf_numbers" value="{{ $client->cpf_numbers }}" placeholder="Digite o CPF do cliente">
                            </div>
                            <div class="col">
                                <label for="phone_number" class="form-label text-muted"><i class="fas fa-phone mr-2"></i> Celular</label>
                                <input type="text" class="form-control form-control-lg" name="phone_number" id="phone_number" value="{{ $client->phone_number }}" placeholder="Digite o número de celular do cliente">    
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label text-muted"><i class="fas fa-map mr-2"></i> Endereço</label>
                            <input type="text" class="form-control form-control-lg" name="address" id="address" value="{{ $client->address }}" placeholder="Digite o e-mail do cliente">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg btn-success rounded-pill shadow-sm">
                                <i class="fas fa-save mr-2"></i> Atualizar Cliente
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