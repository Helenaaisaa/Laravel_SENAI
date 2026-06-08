<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Produtos 💻</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --secondary: #0f172a;
            --success: #16a34a;
            --warning: #ea580c;
            --danger: #dc2626;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
            --white: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(circle at top left, #3b82f6 0%, transparent 30%),
                radial-gradient(circle at bottom right, #1e3a8a 0%, transparent 35%),
                linear-gradient(135deg, #0f172a 0%, #111827 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            overflow-x: hidden;
        }

        .background-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(37, 99, 235, 0.25);
            filter: blur(120px);
            border-radius: 50%;
            top: -150px;
            left: -150px;
            z-index: 0;
        }

        .background-glow-2 {
            position: absolute;
            width: 450px;
            height: 450px;
            background: rgba(59, 130, 246, 0.18);
            filter: blur(120px);
            border-radius: 50%;
            bottom: -120px;
            right: -120px;
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1100px; /* Mais amplo para acomodar a tabela de relatórios */
        }

        .card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 28px;
            padding: 45px;
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.25),
                0 10px 20px rgba(37, 99, 235, 0.15);
            animation: fadeUp 0.8s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .decoration-line {
            width: 70px;
            height: 5px;
            border-radius: 999px;
            background: linear-gradient(to right, var(--primary), #60a5fa);
            margin: 0 auto 20px;
        }

        /* Container de Rolagem para Tabelas Responsivas */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 16px;
            border: 1px solid var(--border);
            background-color: var(--white);
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.95rem;
        }

        th {
            background-color: #f1f5f9;
            color: var(--text);
            font-weight: 700;
            padding: 16px 20px;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 16px 20px;
            color: var(--text);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Alinhamentos Semânticos */
        .text-center { text-align: center; }
        .text-right { text-align: right; }

        /* Estilização de Elementos Internos da Tabela */
        .badge-id {
            background-color: #e2e8f0;
            color: var(--secondary);
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .product-price {
            font-weight: 600;
            color: var(--secondary);
        }

        .empty-state {
            padding: 40px text-align center;
            color: var(--text-light);
            font-size: 1rem;
        }

        /* Botões de Ação na Tabela */
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background-color: rgba(234, 88, 12, 0.1);
            color: var(--warning);
        }

        .btn-edit:hover {
            background-color: var(--warning);
            color: var(--white);
        }

        .btn-delete {
            background-color: rgba(220, 38, 38, 0.1);
            color: var(--danger);
        }

        .btn-delete:hover {
            background-color: var(--danger);
            color: var(--white);
        }

        /* Botão de Rodapé (Cadastrar Novo) */
        .footer-actions {
            display: flex;
            justify-content: center;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            border-radius: 18px;
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.28);
            transition: all 0.35s ease;
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 35px rgba(37, 99, 235, 0.4);
        }

        .btn-add:active {
            transform: scale(0.98);
        }

        @media (max-width: 768px) {
            .card {
                padding: 30px 20px;
                border-radius: 24px;
            }

            .title {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>

    <div class="background-glow"></div>
    <div class="background-glow-2"></div>

    <div class="container">

        <div class="card">

            <div class="header-section">
                <h1 class="title">Relatório de Produtos</h1>
                <div class="decoration-line"></div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 70px;">ID</th>
                            <th>Nome</th>
                            <th class="text-center">Qtd</th>
                            <th>Preço</th>
                            <th>Setor</th>
                            <th>Descrição</th>
                            <th>Tamanho</th>
                            <th>Peso</th>
                            <th class="text-center" style="width: 110px;">Editar</th>
                            <th class="text-center" style="width: 110px;">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produtos as $produto)
                            <tr>
                                <td class="text-center">
                                    <span class="badge-id">#{{ $produto->id }}</span>
                                </td>
                                <td><strong>{{ $produto->nome }}</strong></td>
                                <td class="text-center">{{ $produto->quantidade }}</td>
                                <td class="product-price">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td>{{ $produto->setor?->nomeSetor ?? 'Não Informado' }}</td>
                                <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $produto->detalhes?->descricao ?? '-' }}
                                </td>
                                <td>{{ $produto->detalhes?->tamanho ?? '-' }}</td>
                                <td>{{ $produto->detalhes?->peso ? $produto->detalhes->peso . ' kg' : '-' }}</td>

                                {{-- Ação: Editar --}}
                                <td class="text-center">
                                    <a href="{{ route('produto.editar', $produto->id) }}" class="btn-action btn-edit">
                                        <i class='bx bx-edit-alt'></i>
                                        Editar
                                    </a>
                                </td>

                                {{-- Ação: Deletar --}}
                                <td class="text-center">
                                    <form action="{{ route('produto.deletar', $produto->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este produto?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class='bx bx-trash'></i>
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center empty-state" style="padding: 50px 0;">
                                    <i class='bx bx-search-alt' style="font-size: 40px; display: block; margin-bottom: 10px; color: var(--text-light);"></i>
                                    Nenhum produto encontrado no estoque.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="footer-actions">
                <a href="{{ route('produto.cadastro') }}" class="btn-add">
                    <i class='bx bx-plus-circle'></i>
                    Cadastrar Novo Produto
                </a>
            </div>

        </div>

    </div>

</body>

</html>