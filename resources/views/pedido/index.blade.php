@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4"><h4>Listagem de pedidos</h4></div>
    </div>
    <div class="row">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#Número</th>
                    <th>Cliente</th>
                    <th>Mesa</th>
                    <th>Forma de pagamento</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->numero }}</td>
                        <td>{{ $pedido->cliente }}</td>
                        <td>{{ $pedido->mesa }}</td>
                        @if (isset($pedido->forma_pagamento->descricao))
                            <td>{{ $pedido->forma_pagamento->descricao }}</td>
                        @else
                            <td></td>
                        @endif
                        <td><a href="{{ route('pedido.edit'   , ['numero' => $pedido->numero]) }}">Editar</a></td>
                        <td><a href="{{ route('pedido.destroy', ['numero' => $pedido->numero]) }}">Excluir</a></td>
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
        <a href="{{ route('pedido.create') }}" class="btn btn-primary">Incluir pedido</a>
    </div>
</div>
@endsection