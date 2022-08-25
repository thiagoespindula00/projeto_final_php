@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4"><h4>Listagem de tipos de produto</h4></div>
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
                @foreach($tipos_produto as $tipo_produto)
                    <tr>
                        <td>{{ $tipo_produto->id }}</td>
                        <td>{{ $tipo_produto->codigo }}</td>
                        <td>{{ $tipo_produto->descricao }}</td>
                        <td><a href="{{ route('tipo_produto.edit'   , ['id' => $tipo_produto->id]) }}">Editar</a></td>
                        <td><a href="{{ route('tipo_produto.destroy', ['id' => $tipo_produto->id]) }}">Excluir</a></td>
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
        <a href="{{ route('tipo_produto.create') }}" class="btn btn-primary">Incluir tipo de produto</a>
    </div>
</div>
@endsection