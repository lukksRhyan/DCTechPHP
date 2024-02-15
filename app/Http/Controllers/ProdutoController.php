<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{


    public function __invoke()
    {
        dd('invokado');
    }

    public function index($nome_produto = null, $id_produto = null)
    {

        return view('produto.index', ['nome_produto'=> $nome_produto, 'id_produto' => $id_produto]);
    }

    public function get_all()
    {
        return view('produtos.index');
    }
}
