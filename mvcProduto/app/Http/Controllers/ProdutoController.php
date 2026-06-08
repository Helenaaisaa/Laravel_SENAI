<?php
// estou no ProdutiController.php
namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\Setores;
use App\Models\DetalheProdutos;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function listar(){
        $produtos = Produto::with(['setor', 'detalhesProdutos'])->get();
        return view('listarProdutos', compact('produtos'));
    }

    // produtoController
    public function cadastro(){
        if(auth()->user()->tipo != 'usuario'){
            abort(403);
            // return view('cadastroUsuario'); -> direcione para tela desejada caso não tenha cadastro
        }

        $setores = Setores::get();
        return view('cadastroProduto', compact('setores'));
    }

    public function add(Request $request){

        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|numeric|max:255',
            'valor' => 'required|numeric',
            'setor_id' => 'nullable|exists:setores,id' 
            // para poder ser nulo ou existir na tabela setores
        ]);

        $produto = Produto::create([
            'nome' => $request->nome,
            'quantidade' => $request->quantidade,
            'valor' => $request->valor,
            'setor_id' => $request->setor_id
        ]);

        DetalheProdutos::create([
            'descricao' => $request->descricao,
            'peso' => $request->peso,
            'tamanho' => $request->tamanho,
            'produto_id' => $produto->id
        ]);

        return redirect()->back()->with('success','Produto Cadastrado com sucesso!');

    }

    public function atualizar($id){
        $produto = Produto::findOrFail($id); // Busca o produto pelo ID
        $setores = Setores::get();
        // select * from produtos where id = $id
        return view('atualizarProduto', compact('produto','setores'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|numeric|max:255',
            'valor' => 'required|numeric',
            'setor_id' => 'nullable|exists:setores,id' 
            // para poder ser nulo ou existir na tabela setores
        ]);

        $produto = Produto::findOrFail($id); // buscar aluno para ser atualizado
        $detalhe = DetalheProdutos::where('produto_id', $produto->id)->first();

        $produto->nome = $request->nome; // atualizando o campo nome
        $produto->quantidade = $request->quantidade; // atualizando o campo quantidade
        $produto->valor = $request->valor; // atualizando o campo valor
        $produto->setor_id = $request->setor_id; // atualizando o campo setor_id

        $produto->save(); // salvando no banco de dados(fazendo update)

        $detalhe->descricao = $request->descricao;
        $detalhe->tamanho = $request->tamanho;
        $detalhe->peso = $request->peso;

        $detalhe->save();

        return redirect()->back()->with('success','Produto atualizado com suceso');
    }

    public function deletar($id){
        $produto = Produto::findOrFail($id); // buscar o produto para depois deletar
        $produto->detalhesProdutos?->delete(); // faz o delete da tabela segundaria primeiro
        $produto->delete(); // faz o delete no banco de dados

        return redirect()->route('produto.listar')
            ->with('success','Aluno excluído com sucesso!');
    }

}