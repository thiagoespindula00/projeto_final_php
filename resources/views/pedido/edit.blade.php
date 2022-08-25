@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('pedido.update', ['numero' => $pedido->numero]) }}" method="post">
        @csrf

        @php
            $nome_cliente;
            $mesa;
            $forma_pagamento_id;
            $produtos_pedido = [];
            $quantidade_prod_pedido = [];
            if (count($errors) > 0)
            {
                $nome_cliente = old('nome_cliente');
                $mesa = old('mesa');
                $forma_pagamento_id = old('forma_pagamento_id');
            }
            else
            {
                $nome_cliente = $pedido->nome_cliente;
                $mesa = $pedido->mesa;
                $forma_pagamento_id = $pedido->forma_pagamento_id;
                
                

                var_dump($pedido->produtos2);
                foreach ($pedido->produtos2 as $produto) {
                    array_push($produtos_pedido, $produto->id);
                    $quantidade_prod_pedido[$produto->id] = $produto->quantidade;
                    var_dump($produto->quantidade);
                }
            }
        @endphp
        <div class="mb-3">
            <label for="nome_cliente" class="form-label">Nome do cliente</label>
            <input type="text" name="nome_cliente" id="nome_cliente" class="form-control" value="{{ $nome_cliente }}">
        </div>
        <div class="mb-3">
            <label for="mesa" class="form-label">Mesa</label>
            <input type="text" name="mesa" id="mesa" class="form-control" value="{{ $mesa }}">
        </div>
        <div class="mb-3">
            <label for="forma_pagamento_id" class="form-label">Forma de pagamento</label>
            <select name="forma_pagamento_id" id="forma_pagamento_id" class="form-select">
                <option value="0"></option>
                @foreach($formas_pagamento as $forma_pagamento)
                    @if ($forma_pagamento->id == $forma_pagamento_id)
                        <option value="{{ $forma_pagamento->id }}" selected>{{ $forma_pagamento->descricao }}</option>
                    @else
                        <option value="{{ $forma_pagamento->id }}">{{ $forma_pagamento->descricao }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Produtos</label>
            @php var_dump($quantidade_prod_pedido);  @endphp;
            @foreach($produtos as $produto)
                <div>
                    @if (in_array($produto->id, $produtos_pedido))
                        <input class="form-check-input" name="produtos_id[]" checked type="checkbox" value="{{ $produto->id }}" id="{{ $produto->id }}">
                    @else
                        <input class="form-check-input" name="produtos_id[]" type="checkbox" value="{{ $produto->id }}" id="{{ $produto->id }}">
                    @endif
                    <label class="form-check-label" for="{{ $produto->id }}">
                        {{ $produto->descricao }}
                    </label>
                </div>
                <div>
                    <label class="form-label" for="quantidade{{ $produto->id }}">Quantidade</label>
                    @if (in_array($produto->id, $produtos_pedido))
                        <input type="number" name="quantidade[]" id="quantidade{{ $produto->id }}" value="{{ $quantidade_prod_pedido[$produto->id] }}" class="form-control">
                    @else
                        <input type="number" name="quantidade[]" id="quantidade{{ $produto->id }}" class="form-control">
                    @endif
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