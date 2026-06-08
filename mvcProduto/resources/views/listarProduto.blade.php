<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Relatório de Alunos</h1>
    <a href="{{route('produto.cadastro')}}">Cadastrar Produto</a>
    <br>
    <a href="{{route('setor.cadastro')}}">Cadastrar Setor</a>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>QUANTIDADE</th>
                <th>VALOR</th>
                <th>NOME SETOR</th>
                <th>DESCRIÇÃO</th>
                <th>TAMANHO</th>
                <th>PESO</th>
                <th>Atualizar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            {{-- @dd($produtos->toArray()); --}}
            @forelse($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>{{ $produto->quantidade }}</td>
                    <td>{{ $produto->valor }}</td>
                    <td>{{ $produto->setor?->nome}}</td>
                    <td>{{ $produto->detalhesProdutos?->descricao}}</td>
                    <td>{{ $produto->detalhesProdutos?->tamanho}}</td>
                    <td>{{ $produto->detalhesProdutos?->peso}}</td>
                    <td>
                        <a href="{{route('produto.atualizar', $produto->id)}}">Atualizar</a>
                    </td>
                    <td>
                        <form action="{{ route('produto.deletar', $produto->id)}}" method="POST"
                            onsubmit="return confirm('Deseja realmente excluir');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3"> Nenhum Produto encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>