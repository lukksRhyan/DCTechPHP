@extends('layouts.app')

@section('title','Exportação em pdf')

@section('content')
<div class="container">
        <h1 class="text-center">Detalhes do Pagamento</h1>
        <h2>Venda #{{ $venda->id }}</h2>
        <p><strong>Vendedor:</strong> {{ $vendedor->nome }}</p>
        <p><strong>Cliente:</strong> {{ $cliente->nome }}</p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Número da Parcela</th>
                    <th scope="col">Data de Vencimento</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parcelas as $parcela)
                <tr>
                    <td>{{ $parcela->numero }}</td>
                    <td>{{ $parcela->data_vencimento->format('d/m/Y') }}</td>
                    <td>R$ {{ number_format($parcela->valor, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection