@extends('layouts.app')

@section('title','checkout')

@section('content')
<div class="col-md-5 col-lg-4 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Seu Carrinho</span>
        <span class="badge bg-primary rounded-pill">{{ count($carrinho) }}</span>
    </h4>
    <ul class="list-group mb-3">
        @foreach($carrinho as $produto)
        <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
                <h6 class="my-0">{{ $produto['produto']->descricao }}</h6>
            </div>
            <span class="text-body-secondary">${{ $produto['produto']->valor }} x</span>
            <span class="text-body-secondary">{{ $produto['quantidade'] }}</span>
            <span class="text-body-secondary">{{ $produto['quantidade']*$produto['produto']->valor }}</span>
        </li>
        @endforeach
        
        <li class="list-group-item d-flex justify-content-between">
            <span>Total (R$)</span>
            <strong>${{ $total }}</strong>
        </li>
    </ul>

</div>
<div class="col-md-7 col-lg-8">
    <h4 class="mb-3">Comprador</h4>
    <form class="needs-validation" novalidate action="{{route('venda.pagamento')}}" method="post">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="" value="{{ $cliente->nome }}" required>

                <div class="invalid-feedback">
                    Nome é obrigatório.
                </div>
            </div>
            <div class="col-12">
        <label for="parcelas" class="form-label">Número de Parcelas</label>
            <select class="form-select" id="parcelas" name="parcelas">
                <option value="1">1x sem juros</option>
                <option value="2">2x sem juros</option>
                <option value="3">3x sem juros</option>
                <option value="4">4x sem juros</option>
            </select>
        </div>    
        <input type="hidden" name="total" value ="{{$total}}">
        <input type="hidden" name="id_venda" value ="{{$venda->id}}">
        <input type="hidden" name="nome_cliente" value ="{{$cliente->nome}}">
        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Prosseguir para pagamento</button>
    </form>
</div>
@endsection
