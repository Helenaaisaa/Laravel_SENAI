<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function listar()
    {
        $alunos = Aluno::all();
        return view('listar', compact('alunos'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:alunos,email'
        ]);

        Aluno::create([
            'nome' => $request->nome,
            'email' => $request->email
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
}