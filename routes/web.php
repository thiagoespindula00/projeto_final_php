<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\TipoProdutoController;
use App\Http\Controllers\OperacaoController;
use App\Http\Controllers\FormaPagamentoController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get ('/tipo_produto/index'       , [TipoProdutoController::class, 'index'  ])->name('tipo_produto.index');
Route::get ('/tipo_produto/create'      , [TipoProdutoController::class, 'create' ])->name('tipo_produto.create');
Route::post('/tipo_produto/store'       , [TipoProdutoController::class, 'store'  ])->name('tipo_produto.store');
Route::get ('/tipo_produto/edit/{id}'   , [TipoProdutoController::class, 'edit'   ])->name('tipo_produto.edit');
Route::post('/tipo_produto/update/{id}' , [TipoProdutoController::class, 'update' ])->name('tipo_produto.update');
Route::get ('/tipo_produto/destroy/{id}', [TipoProdutoController::class, 'destroy'])->name('tipo_produto.destroy');

Route::get ('/operacao/index'       , [OperacaoController::class, 'index'  ])->name('operacao.index');
Route::get ('/operacao/create'      , [OperacaoController::class, 'create' ])->name('operacao.create');
Route::post('/operacao/store'       , [OperacaoController::class, 'store'  ])->name('operacao.store');
Route::get ('/operacao/edit/{id}'   , [OperacaoController::class, 'edit'   ])->name('operacao.edit');
Route::post('/operacao/update/{id}' , [OperacaoController::class, 'update' ])->name('operacao.update');
Route::get ('/operacao/destroy/{id}', [OperacaoController::class, 'destroy'])->name('operacao.destroy');

Route::get ('/produto/index'       , [ProdutoController::class, 'index'  ])->name('produto.index');
Route::get ('/produto/create'      , [ProdutoController::class, 'create' ])->name('produto.create');
Route::post('/produto/store'       , [ProdutoController::class, 'store'  ])->name('produto.store');
Route::get ('/produto/edit/{id}'   , [ProdutoController::class, 'edit'   ])->name('produto.edit');
Route::post('/produto/update/{id}' , [ProdutoController::class, 'update' ])->name('produto.update');
Route::get ('/produto/destroy/{id}', [ProdutoController::class, 'destroy'])->name('produto.destroy');

Route::get ('/forma_pagamento/index'       , [FormaPagamentoController::class, 'index'  ])->name('forma_pagamento.index');
Route::get ('/forma_pagamento/create'      , [FormaPagamentoController::class, 'create' ])->name('forma_pagamento.create');
Route::post('/forma_pagamento/store'       , [FormaPagamentoController::class, 'store'  ])->name('forma_pagamento.store');
Route::get ('/forma_pagamento/edit/{id}'   , [FormaPagamentoController::class, 'edit'   ])->name('forma_pagamento.edit');
Route::post('/forma_pagamento/update/{id}' , [FormaPagamentoController::class, 'update' ])->name('forma_pagamento.update');
Route::get ('/forma_pagamento/destroy/{id}', [FormaPagamentoController::class, 'destroy'])->name('forma_pagamento.destroy');

Route::get ('/pedido/index'           , [PedidoController::class, 'index'  ])->name('pedido.index');
Route::get ('/pedido/create'          , [PedidoController::class, 'create' ])->name('pedido.create');
Route::post('/pedido/store'           , [PedidoController::class, 'store'  ])->name('pedido.store');
Route::get ('/pedido/edit/{numero}'   , [PedidoController::class, 'edit'   ])->name('pedido.edit');
Route::post('/pedido/update/{numero}' , [PedidoController::class, 'update' ])->name('pedido.update');
Route::get ('/pedido/destroy/{numero}', [PedidoController::class, 'destroy'])->name('pedido.destroy');
