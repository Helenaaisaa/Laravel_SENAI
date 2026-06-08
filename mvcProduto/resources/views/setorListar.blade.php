<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETOR</title>
</head>
<body>
    <h1>Relatório de SETOR</h1>
    <a href="{{route('produto.cadastro')}}">Cadastrar Produto</a>
    <br>
    <a href="{{route('setor.cadastro')}}">Cadastrar Setor</a>
    <br>
    <!-- AULA E HOJE INICIO-->
    <form method="GET" action="{{ route('setor.listar') }}">
        <input type="text" name="nome" placeholder="Digite o nome do setor"
            value="{{request('nome')}}"
        >
        <button type="submit">Buscar</button>
    </form>
    <!-- AULA DE HOJE FIM-->
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>NUMERO SETOR</th>
            </tr>
        </thead>
        <tbody>
            @forelse($setores as $setor)
                <tr>
                    <td>{{ $setor->id }}</td>
                    <td>{{ $setor->nome }}</td>
                    <td>{{ $setor->num_setor }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3"> Nenhum Setor encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>