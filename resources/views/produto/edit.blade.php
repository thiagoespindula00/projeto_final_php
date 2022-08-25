@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('produto.update', ['id' => $produto->id]) }}" method="post">
        @csrf

        @php
            $codigo;
            $descricao;
            $preco;
            $tipo_produto_id;
            $operacoes_produto = [];
            if (count($errors) > 0)
            {
                $codigo = old('codigo');
                $descricao = old('descricao');
                $preco = old('preco');
                $tipo_produto_id = old('tipo_produto_id');
            }
            else
            {
                $codigo = $produto->codigo;
                $descricao = $produto->descricao;
                $preco = $produto->preco;
                $tipo_produto_id = $produto->tipo_produto_id;
                foreach($produto->operacoes as $operacao)
                    array_push($operacoes_produto, $operacao->id);
            }
        @endphp
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $codigo }}">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="{{ $descricao }}">
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="any" name="preco" id="preco" class="form-control" value="{{ $preco }}">
        </div>
        <div class="mb-3">
            <label for="tipo_produto_id" class="form-label">Tipo de produto</label>
            <select name="tipo_produto_id" id="tipo_produto_id" class="form-select">
                <option value="0"></option>
                @foreach($tipos_produto as $tipo_produto)
                    @if ($tipo_produto->id == $tipo_produto_id)
                        <option value="{{ $tipo_produto->id }}" selected>{{ $tipo_produto->descricao }}</option>
                    @else
                        <option value="{{ $tipo_produto->id }}">{{ $tipo_produto->descricao }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Operações</label>
            @foreach($operacoes as $operacao)
                @if (in_array($operacao->id, $operacoes_produto))
                    <div>
                        <input class="form-check-input" checked name="operacoes_id[]" type="checkbox" value="{{ $operacao->id }}" id="{{ $operacao->id }}">
                        <label class="form-check-label" for="{{ $operacao->id }}">
                            {{ $operacao->descricao }}
                        </label>
                    </div>
                @else
                    <div>
                        <input class="form-check-input" name="operacoes_id[]" type="checkbox" value="{{ $operacao->id }}" id="{{ $operacao->id }}">
                        <label class="form-check-label" for="{{ $operacao->id }}">
                            {{ $operacao->descricao }}
                        </label>
                    </div>
                @endif
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