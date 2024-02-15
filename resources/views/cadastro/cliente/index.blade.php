@extends('layouts.app')
@section('content')
<a href="{{ route('vendedor.dashboard', ['vendedor' => $vendedor]) }}" class="btn btn-primary">Voltar</a>
<div class="container mt-5">
    <h1 class="mb-4">Cadastro de cliente</h1>
    <form action="{{ route('cliente.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>

        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
