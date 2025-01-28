<h1>PRODUCT INDEX</h1>

<a href="{{ route('logout') }}">Sair</a>

<!-- checks if are authenticated -->
@auth
    <h2>{{ auth()->user()->email }}</h2>
@endauth
