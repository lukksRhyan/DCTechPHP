<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Dompdf\Dompdf;
use Dompdf\Options;


use App\Models\Venda;
use App\Models\Vendedor;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Parcela;

class VendaController extends Controller
{

    public function show(Request $request)
    {
        $produtos = Produto::all();
        $vendedor = $request->session()->get('vendedor');
        $clientes = Cliente::all();
        return view('venda.index', compact('vendedor','produtos','clientes'));
    }

    public function checkout(Request $request){

        $vendedorId = $request->input('vendedor_id');
        $clienteId = $request->input('cliente_id');
        $produtos = (array) json_decode($request->input('produtos'), true);
    
        $carrinho  = [];

        foreach ($produtos as $produto_id => $quantidade){
            $produto = Produto::find($produto_id);
            
            $carrinho[] = [
                'produto' => $produto,
                'quantidade' => $quantidade
            ];
        }
        
        $total = 0;
        foreach ($carrinho as $item) {

            $total += $item['produto']->valor * $item['quantidade'];
        }       

        $venda = new Venda();
        $venda->vendedor_id = $vendedorId;
        $venda->cliente_id = $clienteId;
        $venda->save();
        
        $vendedor = $request->session()->get('vendedor');
        $cliente = Cliente::find($clienteId);

        return view('venda.checkout.index',compact('vendedor','venda','cliente','carrinho','total'));
    }

    public function pagamento(Request $request)
    {
        $parcelas = 1;

        if($parcelas < $request->parcelas) $n_parcelas = $request->parcelas;
        
        $valor_parcelas = $request->total / $n_parcelas;

        $parcelas = [];
        
        $nome_cliente = $request->nome_cliente;

        $vendedor = $request->session()->get('vendedor');
        $nome_vendedor = $vendedor->nome;
        $id_venda = $request->id_venda;
        $venda = Venda::findOrFail($id_venda);
        //dd($venda);
        for ($i = 1; $i <= $n_parcelas; $i++) {
            $data_parcela = now()->addMonths($i);
            $data_formatada = $data_parcela->format('Y-m-d');

            Parcela::create([
                'id_venda' => $id_venda,
                'vencimento' => $data_formatada,
                'valor' => $valor_parcelas
            ]);
            
            $parcelas[] =[
                'numero' => $i,
                'data' =>$data_formatada,
                'id_venda'=>$id_venda,
                'valor' => $valor_parcelas
            ];
            
        }

        return view('venda.pagamento.index', compact('parcelas', 'nome_cliente', 'vendedor', 'id_venda'));

    }

    public function finalizar(Request $request)
    {
        $id_venda = $request->id_venda;

        return view('venda.finalizar.index',compact('id_venda'));
    }


    public function gerarPDF($id_venda)
    {
        $venda = Venda::findOrFail($id_venda);
        $vendedor = Vendedor::findOrFail($venda->vendedor_id);
        $cliente = Cliente::findOrFail($venda->cliente_id);
        $nome_cliente = $cliente->nome;

   
        $parcelas = Parcela::where('venda_id', $id_venda)->get();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml( view('venda.pagamento.index',compact('id_venda','vendedor','nome_cliente','parcelas')));

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("pagamento_{$id_venda}.pdf");
    }

}
