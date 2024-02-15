<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Funcionario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'cpf' => 'required|string',
            'senha' => 'required|string',
        ]);

        $funcionario = Funcionario::where('cpf', $request->cpf)->first();

        if (!$funcionario || !Hash::check($request->senha, $funcionario->senha)) {
            return back()->withErrors(['cpf' => 'Dados inválidos.']);
        }

        Auth::login($funcionario);

        return redirect()->intended('/dashboard');
        dd('login chamado');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
