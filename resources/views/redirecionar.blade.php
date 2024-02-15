<!DOCTYPE html>
<html>
<head>
    <title>Redirecionando...</title>
</head>
<body onload="document.forms['redirectForm'].submit()">
    <form id="redirectForm" action="{{ route('venda.create') }}" method="POST">
        @csrf
        <input type="hidden" name="vendedor_id" value="{{ $vendedor->id }}">
    </form>
</body>
</html>
