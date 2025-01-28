<form action="{{ route('login.post') }}" method="post">
    @csrf
    <input type="text" name="email" id="" placeholder="email">
    <input type="password" name="password" id="" placeholder="senha">
    <button type="submit">Enviar</button>
</form>