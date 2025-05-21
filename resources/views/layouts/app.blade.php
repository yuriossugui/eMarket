<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'eMarket')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap @4.6.2/dist/css/bootstrap.min.css">
    <!-- Estilos customizados -->
    @stack('styles')
</head>
<body>

    <!-- Barra de Navegação -->
    @include('partials.navbar')

    <!-- Conteúdo Principal -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Rodapé -->
    <footer class="bg-light text-center py-3">
        <p class="mb-0">&copy; {{ date('Y') }} Minha Loja</p>
    </footer>

    <!-- Bootstrap JS e dependências -->
    <script src="https://cdn.jsdelivr.net/npm/jquery @3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap @4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts customizados -->
    @stack('scripts')
</body>
</html>