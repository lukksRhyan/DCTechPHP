<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Vendedor;

class ClienteController extends Controller
{
    public function create(Vendedor $vendedor)
    {

        return view('cadastro.cliente.index',['vendedor' => $vendedor]);
    }

    public function store(Request $request)
    {


        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'cpf' => 'required|string|max:14|unique:clientes,cpf',
        ]);

        $cliente = new Cliente();
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->cpf = $request->input('cpf');
        
        

        $cliente->save();

        return redirect()->back()->with('success', 'Cliente cadastrado com sucesso!');
    }
}
