<form action="{{ route('login.post') }}" method="post">
    @csrf
    <input type="text" name="email" id="" placeholder="email">
    <input type="password" name="password" id="" placeholder="senha">
    <button type="submit">Enviar</button>
</form>

@if($msg = Session::get('error'))
    {{$msg}}
@endif

@if($errors->any())
    <p>Erro ao entrar: </p>
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif