<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>
</head>
<body>
    <h1>Cadastro Usuário</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success')}}</p>
    @endif

    <form action="{{route('usuario.salvar') }}" method="POST">
        @csrf
        <label for="name">Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome..."
            require value="{{ old('name') }}"
        >
        <br><br>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" placeholder="Email..."
            required value="{{ old('email')}}"
        >
        <br><br>
        <label for="password">Senha: </label>
        <input type="password" name="password" id="password" placeholder="Senha..."
            required value="{{ old('password')}}"
        >

        <br><br>
        <label for="tipo">Tipo: </label>
        <select name="tipo" id="tipo">
            <option value="usuario">Usuário</option>
            <option value="admin">Administrador</option>
        </select>


        <input type="submit" value="Cadastrar">
    </form>

    @if($errors->any())
        <div style="color:red">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>