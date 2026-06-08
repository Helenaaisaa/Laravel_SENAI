<?php
// estou no SetorApiController.php
namespace App\Http\Controllers;
use App\Models\Produto;
use App\Models\Setores;

use Illuminate\Http\Request;

class SetorApiController extends Controller
{
    public function listarApi(Request $request){
        try{
            $query = Setores::query();

            // filtro por nome
            // select * from setores where nome like %NOME%
            if($request->filled('nome')){
                $query->where('nome', 'like', '%'.$request->nome .'%');
            }
            // filtros por número do setor
            // select * from setores where num_setor = NUM_SETOR
            if($request->filled('num_setor')){
                $query->where('num_setor', $request->num_setor);
            }

            $setores = $query->get();

            return response()->json([
                'success' => true,
                'data' => $setores
            ], 200);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    
    public function addApi(Request $request){

        try{
            $request->validate([
                'nome' => 'required|string|max:255',
                'num_setor' => 'required|numeric|max:255',
                // para poder ser nulo ou existir na tabela setores
            ]);

            $setor = Setores::create([
                'nome' => $request->nome,
                'num_setor' => $request->num_setor
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Setor Criado',
                'setor' => $setor
            ], 200);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor',
                'errors' => $e->getMessage()
            ], 500);
        }

    }
    
    public function updateApi(Request $request, $id){
        try{
            $request->validate([
                'nome' => 'required|string|max:255',
                'num_setor' => 'required|numeric|max:255',
            ]);

            $setor = Setores::findOrFail($id); // buscar setor para ser atualizado

            $setor->nome = $request->nome; // atualizando o campo nome
            $setor->num_setor = $request->num_setor; // atualizando o campo quantidade

            $setor->save(); // salvando no banco de dados(fazendo update)

            return response()->json([
                'message' => "Setor atualizado!",
                'setor' => $setor
            ], 200);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => 'Setor não encontrado'
            ], 404);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor',
                'errors' => $e->getMessage()
            ], 500);
        }
    }

    public function deletarApi($id){
        try{
            $setor = Setores::findOrFail($id); // buscar o setor para depois deletar
            $setor->delete(); // faz o delete no banco de dados

            return response()->json([
                'message' => "Setor Deletado com Sucesso!",
            ], 200);
        }catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json([
                'success' => false,
                'message' => 'Setor não encontrado'
            ], 404);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor',
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}