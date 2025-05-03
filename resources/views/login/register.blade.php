<h1>Register form</h1>

<form action="" method="post">
    @csrf

    <input type="text" name="name" placeholder="name">

    <input type="email" name="email" placeholder="email">

    <input type="password" name="password" placeholder="password">

    <select name="role" id="role">
        <option value="user">Usuário</option>
        <option value="admin">Administrador</option>
    </select>

    <button type="submit">Cadastrar</button>

</form>