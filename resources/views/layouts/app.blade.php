<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'eMarket')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Estilos customizados -->
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Barra de Navegação -->
    @include('partials.navbar')

    <!-- Conteúdo Principal -->
    <main class="container my-4">   
        @yield('content')
    </main>

    <!-- Rodapé -->
    <footer class="bg-light text-center py-3 mt-auto">
        <p class="mb-0">&copy; {{ date('Y') }} eMarket</p>
    </footer>

    <!-- Bootstrap JS e dependências -->
    <script src="{{asset('assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Scripts customizados -->
    @stack('scripts')
</body>
</html>