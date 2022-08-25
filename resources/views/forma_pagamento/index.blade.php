@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4"><h4>Listagem de formas de pagamento</h4></div>
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
                @foreach($formas_pagamento as $forma_pagamento)
                    <tr>
                        <td>{{ $forma_pagamento->id }}</td>
                        <td>{{ $forma_pagamento->codigo }}</td>
                        <td>{{ $forma_pagamento->descricao }}</td>
                        <td><a href="{{ route('forma_pagamento.edit'   , ['id' => $forma_pagamento->id]) }}">Editar</a></td>
                        <td><a href="{{ route('forma_pagamento.destroy', ['id' => $forma_pagamento->id]) }}">Excluir</a></td>
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
        <a href="{{ route('forma_pagamento.create') }}" class="btn btn-primary">Incluir forma de pagamento</a>
    </div>
</div>
@endsection