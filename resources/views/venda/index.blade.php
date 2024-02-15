@extends('layouts.app')

@section('title')
Nova Venda
@endsection

<!DOCTYPE html>
<html>
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Detalhes da Venda</h1>
        <div class="mb-3">
            <label for="vendedor" class="form-label">Vendedor</label>
            <input type="text" class="form-control" id="vendedor" value="{{ $vendedor->nome }}" readonly>
        </div>
        <div class="mb-3">

</div>

        <h2>Produtos</h2>
<table class="table">
    <thead>
        <tr>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Estoque</th>
            <th>Quantidade</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
        <tr>
            <td id="descricao__{{$produto->id}}">{{ $produto->descricao }}</td>
            <td>{{ $produto->valor }}</td>
            <td id="estoque__{{$produto->id}}">{{ $produto->estoque }}</td>
            <td>
                <input type="number" id="quantidade_{{ $produto->id }}" name="quantidade_{{ $produto->id }}" value="0" min="0" max="{{ $produto->estoque }}">
            </td>
            <td>
                <button type="button" class="btn btn-primary" onclick="adicionarProduto({{ $produto->id }})">Adicionar</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<form id="form-adicionar-produto" action="{{ route('venda.checkout') }}" method="POST">
    @csrf
    <input type="hidden" name="vendedor_id" value="{{ $vendedor->id }}">
    <div class="mb-3">
        <label for="cliente" class="form-label">Cliente</label>
        <select class="form-select" id="cliente" name="cliente_id">
            <option value="">Selecione um cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="produtos" id="input-produtos">
    <button type="button" class="btn btn-primary" onclick="finalizarVenda()">Finalizar Venda</button>
</form>


<script>
    var produtos = {};

    function adicionarProduto(produtoId) {
    var quantidadeInput = document.getElementById('quantidade_' + produtoId);
    var quantidade = parseInt(quantidadeInput.value);
    var estoque = parseInt(document.getElementById('estoque__'+ produtoId).textContent);

    if (quantidade > estoque)  {
        alert('Quantidade insuficiente no produto: ' + document.getElementById('descricao__'+ produtoId).textContent);
        quantidadeInput.value = estoque; // Corrigir automaticamente a quantidade para o valor do estoque
        produtos[produtoId] = estoque;
        return;
    }

    if (quantidade <= 0 || isNaN(quantidade)) {
        alert('A quantidade deve ser um número válido e maior que zero.');
        quantidadeInput.value = 1; // Definir a quantidade de volta para 1
        return;
    }

    produtos[produtoId] = quantidade;

    console.log(produtos);
}

    function finalizarVenda() {
        var inputProdutos = document.getElementById('input-produtos');
        inputProdutos.value = JSON.stringify(produtos);

        document.getElementById('form-adicionar-produto').submit();
    }
</script>

    </div>
</body>
</html>
