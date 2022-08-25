@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('produto.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') }}">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="{{ old('descricao') }}">
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="any" min="0" name="preco" id="preco" class="form-control" value="{{ old('preco') }}">
        </div>
        <div class="mb-3">
            <label for="tipo_produto_id" class="form-label">Tipo de produto</label>
            <select name="tipo_produto_id" id="tipo_produto_id" class="form-select">
                <option value="0"></option>
                @foreach($tipos_produto as $tipo_produto)
                    <option value="{{ $tipo_produto->id }}">{{ $tipo_produto->descricao }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Operações</label>
            @foreach($operacoes as $operacao)
                <div>
                    <input class="form-check-input" name="operacoes_id[]" type="checkbox" value="{{ $operacao->id }}" id="{{ $operacao->id }}">
                    <label class="form-check-label" for="{{ $operacao->id }}">
                        {{ $operacao->descricao }}
                    </label>
                </div>
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