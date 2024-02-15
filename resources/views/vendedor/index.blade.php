<?php $vendedor = session()->get('vendedor');?>
@extends('layouts.app')

@section('title', 'Vendas do Vendedor')


@section('content')
    <div class="container">
        <h1>Vendas do Vendedor</h1>
        <h1>{{$vendedor->nome}}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data da Venda</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <a href="{{ route('cliente.create', ['vendedor' => $vendedor]) }}" class="btn btn-primary">Cadastrar Cliente</a>
            <a href="{{ route('venda.show') }}" class="btn btn-primary">Criar Nova Venda</a>
            <tbody>
            @if($vendas->count() > 0)
            <table class="table">
                @foreach($vendas as $venda)
                    <tr>
                        <td>{{ $venda->id }}</td>
                        <td>{{ $venda->created_at->format('d/m/Y') }}</td>
                        <td>{{ $venda->cliente_id }}</td>
                        <td>{{ $venda->total }}</td>
                        <td>
                            <a href="{{ route('venda.show', $venda->id) }}" class="btn btn-sm btn-primary">Detalhes</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
            <p>Nenhuma venda encontrada.</p>
            @endif
               
            </tbody>
        </table>
    </div>
@endsection
