@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('pedido.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="nome_cliente" class="form-label">Nome do cliente</label>
            <input type="text" name="nome_cliente" id="nome_cliente" class="form-control" value="{{ old('nome_cliente') }}">
        </div>
        <div class="mb-3">
            <label for="mesa" class="form-label">Mesa</label>
            <input type="text" name="mesa" id="mesa" class="form-control" value="{{ old('mesa') }}">
        </div>
        <div class="mb-3">
            <label for="forma_pagamento_id" class="form-label">Forma de pagamento</label>
            <select name="forma_pagamento_id" id="forma_pagamento_id" class="form-select">
                <option value="0"></option>
                @foreach($formas_pagamento as $forma_pagamento)
                    <option value="{{ $forma_pagamento->id }}">{{ $forma_pagamento->descricao }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Produtos</label>
            @foreach($produtos as $produto)
                <div>
                    <input class="form-check-input" name="produtos_id[]" type="checkbox" value="{{ $produto->id }}" id="{{ $produto->id }}">
                    <label class="form-check-label" for="{{ $produto->id }}">
                        {{ $produto->descricao }}
                    </label>
                </div>
                <div>
                    <label class="form-label" for="quantidade{{ $produto->id }}">Quantidade</label>
                    <input type="number" name="quantidade[]" id="quantidade{{ $produto->id }}"  class="form-control">
                </div>
                <br>
            @endforeach
        </div>

        @if(count($errors) > 0)
        <div class="row">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="mb-3">
            <input type="submit" value="Salvar" class="btn btn-success">
            <input type="submit" name="cancel" value="Cancelar" class="btn btn-success">
        </div>
    </form>
</div>
@endsection