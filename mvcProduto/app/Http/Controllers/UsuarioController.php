<?php
// estou no UserController.php
namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function add(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            // dois usuarios nao podem ter o mesmo email
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'tipo' => 'required'
            
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo
        ]);

        return redirect()->back()->with('success','Usuario cadastrado com sucesso!');
    }

    // ESTOU NA USER CONTROLLER

    public function autenticar(Request $request){
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credenciais)){
            $request->session()->regenerate();
            // ao fazer o login envia para a tela produto listar
            return redirect()->route('produto.listar');
        }

        return back()->withErrors(['email' => 'E-mail ou senha inválidos.']);
    }

        public function trocarSenha(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // busca o usuario que será trocado a senha
        $usuario = User::where('email', $request->email)->first();

        if(!$usuario){
            return back()->withErrors([
                'email' => 'Usuário não encontrado.'
            ]);
        }

        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return back()->with('success', 'Senha alterada com sucesso!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}