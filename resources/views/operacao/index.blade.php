@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4"><h4>Listagem de operações</h4></div>
    </div>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($operacoes as $operacao)
                    <tr>
                        <td>{{ $operacao->id }}</td>
                        <td>{{ $operacao->codigo }}</td>
                        <td>{{ $operacao->descricao }}</td>
                        <td><a href="{{ route('operacao.edit'   , ['id' => $operacao->id]) }}">Editar</a></td>
                        <td><a href="{{ route('operacao.destroy', ['id' => $operacao->id]) }}">Excluir</a></td>
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
        <a href="{{ route('operacao.create') }}" class="btn btn-primary">Incluir operação</a>
    </div>
</div>
@endsection