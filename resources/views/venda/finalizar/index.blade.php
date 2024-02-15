@extends('layouts.app')

@section('title','Finalizar')

@section('content')
<h1>Venda Finalizada com sucesso!!!</h1>
<a href="{{ route('venda.pdf', ['id_venda' => $id_venda]) }}" class="btn btn-primary">Gerar PDF</a>
@endsection