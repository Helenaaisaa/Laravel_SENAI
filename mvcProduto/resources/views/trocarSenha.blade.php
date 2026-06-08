<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar Senha</title>
</head>
<body>
    <h1>Trocar Senha</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success')}}</p>
    @endif

    <form action="{{route('mudar.senha') }}" method="POST">
        @csrf
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" placeholder="Email..."
            required value="{{ old('email')}}"
        >
        <br><br>
        <label for="password">Nova Senha: </label>
        <input type="password" name="password" id="password" placeholder="Nova Senha..."
            required"
        >

        <input type="submit" value="Trocar Senha">
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