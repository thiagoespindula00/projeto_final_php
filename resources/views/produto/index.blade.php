@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4"><h4>Listagem de produtos</h4></div>
    </div>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Tipo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                    <tr>
                        <td>{{ $produto->id }}</td>
                        <td>{{ $produto->codigo }}</td>
                        <td>{{ $produto->descricao }}</td>
                        <td>{{ $produto->preco }}</td>
                        @if (isset($produto->tipo_produto->descricao))
                            <td>{{ $produto->tipo_produto->descricao }}</td>
                        @else
                            <td></td>
                        @endif
                        <td><a href="{{ route('produto.edit'   , ['id' => $produto->id]) }}">Editar</a></td>
                        <td><a href="{{ route('produto.destroy', ['id' => $produto->id]) }}">Excluir</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(Session::has('message'))
        <div class="row">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>{!! session()->get('message') !!}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="col-md-8">
        <a href="{{ route('produto.create') }}" class="btn btn-primary">Incluir produto</a>
    </div>
</div>
@endsection