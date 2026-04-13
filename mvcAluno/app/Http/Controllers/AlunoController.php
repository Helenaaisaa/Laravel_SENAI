<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function listar()
    {
        $alunos = Aluno::with('turma')->get();
        return view('listar', compact('alunos'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:alunos,email',
            'turma_id' => 'nullable|exists:turmas,id' // para poder ser nulo ou existir na tabela turmas 
        ]);

        Aluno::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'turma_id' => $request->turma_id
        ]);

        return redirect()->back()->with('success', 'Aluno cadastrado com sucesso!');
    }

     public function atualizar($id){
            $aluno = Aluno::findOrFail($id); //busca o aluno pelo ID
            return view('atualizar', compact('aluno'));
        }

    public function update(Request $request, $id){
        $request->validate([
            'nome' => 'required|string|max:255',
            'email'=> "required|string|max:255|unique:alunos,email, $id"
        ]);

        $aluno = Aluno::findOrFail($id); //buscar aluno para ser atualizado

        $aluno->nome = $request->nome; //atualizando o campo nome
        $aluno->email = $request->email; //atualizando campo email

        $aluno->save(); //salvando no banco de dados (fazendo o update)
        return redirect()->back()->with('success','Aluno atualizado com sucesso');
    }

    public function deletar($id){
        $aluno = Aluno::findOrFail($id); //buscar o aluno para depois deletar
        $aluno->delete(); //faz o delete no banco de dados
        return redirect()->route('aluno.listar')->with('success','Aluno excluído com sucesso!');
    }
}