<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Vendedor;
use App\Http\Controllers\VendaController;
use App\Models\Venda;

class VendedorController extends Controller
{
    public function __invoke()
    {
        dd('vendedor invokado');
    }

    public function index(Request $request)
    {
        if(!isset($vendedor)){
            $vendedor = $request->session()->get('vendedor');
        }   
            $vendas = Venda::where('vendedor_id', $vendedor->id)->get();
            return view('vendedor.index', compact('vendas','vendedor'));
    }


    public function get_all()
    {
        $vendedores = Vendedor::all();
        dd($vendedores);
    }

    public function login()
    {
        return view('/login/vendedor/index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'cpf' => 'required|string',
            'email' => 'required|string',
        ]);
        $vendedor = Vendedor::where('cpf', $request->cpf)->where('email', $request->email)->first();

        //dd(Vendedor::all());
        //dd($vendedor);
        
        if(!$vendedor){
            return response()->json(['error' => 'Vendedor não encontrado.'], 404);
        }

        Session::put('vendedor', $vendedor);
        return redirect()->route('vendedor.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}

