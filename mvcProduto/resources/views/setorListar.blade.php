<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="pt-BR">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Setor</title>
</head>
<style>
    table{
        text-align: center
    }
</style>
<body>
    <h1>Relatório dos Setores</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>SETOR</th>
                <th>N° CORREDOR</th>
            </tr>
        </thead>
        <tbody>
            @forelse($setores as $setor)
                <tr>
                    <td>{{ $setor->id }}</td>
                    <td>{{ $setor->nome }}</td>
                    <td>{{ $setor->nCorredor }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum produto encontrado</td> 
                </tr>
            @endforelse
        </tbody>
    </table>
    
</body>
</html>