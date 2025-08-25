<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Logo/Brand -->
        <a class="navbar-brand" href="">eMarket</a>

        <!-- Botão para mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links da Navbar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="">Loja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Produtos</a>
                </li>
            </ul>

            <!-- Dropdown do Perfil -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="perfilDropdown" role="button" data-toggle="dropdown">
                        Perfil
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="perfilDropdown">
                        @if(auth()->check())
                            <p class="dropdown-item">Bem vindo, {{ auth()->user()->name }} </p>
                            <a class="dropdown-item" href="{{ route('cart.index') }}">Carrinho</a>
                            <a class="dropdown-item" href="">Pedido</a>
                            <a class="dropdown-item" href="">Informações</a>
                        @else
                            <p class="dropdown-item">Nao logado</p>
                            <p class="dropdown-item" href="">Faça login para acessar seu perfil</p>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>