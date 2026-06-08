<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atualizar Produto</title>
</head>
<body>
    <h1>Atualizar Produto</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('produto.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="Nome..."
            require value="{{ old('nome', $produto->nome) }}"
        >
        <br><br>
        <label for="quantidade">Quantidade: </label>
        <input type="number" name="quantidade" id="quantidade" placeholder="Quantidade..."
            required value="{{ old('quantidade', $produto->quantidade)}}"
        >
        <br><br>
        <label for="valor">Valor: </label>
        <input type="number" name="valor" id="valor" placeholder="Valor..."
            required value="{{ old('valor', $produto->valor)}}"
        >

        <br><br>
        <label for="setor_id">Setores: </label>
        <select name="setor_id" id="setor_id">
            @foreach ($setores as $setor)
                <option value="{{ $setor->id }}"
                    {{ $produto->setor_id == $setor->id ? 'selected' : '' }}>
                    {{ $setor->nome }}
                </option>
            @endforeach
        </select>

        <br><br>
        <label for="descricao">Descricao: </label>
        <input type="text" name="descricao" id="descricao" placeholder="Descricao..."
            required value="{{ old('descricao', $produto->detalhesProdutos->descricao)}}"
        >

        <br><br>
        <label for="tamanho">Tamanho: </label>
        <input type="number" name="tamanho" id="tamanho" placeholder="Tamanho..."
            required value="{{ old('tamanho', $produto->detalhesProdutos->tamanho)}}"
        >

        <br><br>
        <label for="peso">Peso: </label>
        <input type="number" name="peso" id="peso" placeholder="Peso..."
            required value="{{ old('peso', $produto->detalhesProdutos->peso)}}"
        >

        <button type="submit">Atualizar</button>
    </form>

    @if($errors->any())
        <div style="color: red">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>