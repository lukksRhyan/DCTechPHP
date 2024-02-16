@extends('layouts.app')

@section('title', 'pagamento')

@section('content')
<div class="col-md-7 col-lg-8">
    <h4 class="mb-3">Compra nº {{$id_venda}} </h4>
    <p><strong>Vendedor:</strong> {{ $vendedor->nome }}</p>
    <p><strong>Cliente:</strong> {{ $nome_cliente }}</p>
    
    <h4 class="mb-3">Parcelas</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Número da Parcela</th>
                <th>Data de Vencimento</th>
                <th>Valor da Parcela</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parcelas as $parcela)
            <tr>
                <td>{{ $parcela['numero'] }}</td>
                <td>{{ $parcela['data'] }}</td>
                <td>{{ $parcela['valor'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('venda.pdf', ['id_venda' => $id_venda]) }}" class="btn btn-primary">Gerar PDF</a>
</div>
@endsection