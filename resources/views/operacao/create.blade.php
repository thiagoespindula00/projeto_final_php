@extends('layouts.app')
@section('content')
<div class="container">
    <form action="{{ route('operacao.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') }}">
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="{{ old('descricao') }}">
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