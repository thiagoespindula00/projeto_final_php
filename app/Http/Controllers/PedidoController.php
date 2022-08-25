<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\FormaPagamento;
use App\Models\Produto;
use Symfony\Component\VarDumper\VarDumper;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedido.index', compact('pedidos'));
    }
    
    public function create() {
        $formas_pagamento = FormaPagamento::all();
        $produtos = Produto::all();
        return view('pedido.create', compact('formas_pagamento', 'produtos'));
    }

    public function store(Request $request)
    {
        if (! $request->has('cancel'))
        {
            $this->validate($request, [
                'nome_cliente' => 'required',
                'mesa' => 'required'
            ], [
                'required' => 'O campo :attribute deve ser informado'
            ]);
            if (isset($request['produtos_id'])) {
                for($idxProduto = 0; $idxProduto < sizeof($request['produtos_id']); $idxProduto++){

                    if (!isset($request['quantidade']) || $request['quantidade'][$idxProduto] == 0 || $request['quantidade'][$idxProduto] == "") {
                        return redirect()->to(route('pedido.create'))->withErrors(['Informe quantidade para todos os produtos!']);
                    }
                }

                $pedido = new Pedido($request->all());
                $pedido->save();
                $numero = $pedido->numero;

                for($idxProduto = 0; $idxProduto < sizeof($request['produtos_id']); $idxProduto++){
                    $preco = Produto::find($request['produtos_id'][$idxProduto])->preco;

                    $pedido->produtos()->attach(
                    $request['produtos_id'][$idxProduto],
                    [
                        'quantidade' => $request['quantidade'][$idxProduto],
                        'preco' => $preco
                    ]
                    );
                }
            } else {
                return redirect()->to(route('pedido.create'))->withErrors(['Informe no mínimo um produto!']);
            }
            $request->session()->flash('message', 'Pedido cadastrado com sucesso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('pedido.index'));
    }

    public function edit($numero)
    {
        $pedido = Pedido::find($numero);
        $formas_pagamento = FormaPagamento::all();
        $produtos = Produto::all();
        return view('pedido.edit', compact('pedido', 'formas_pagamento', 'produtos'));
    }

    public function update(Request $request, $numero)
    {
        if (!$request->has('cancel'))
        {
            $this->validate($request, [
                'nome_cliente' => 'required',
                'mesa' => 'required'
            ], [
                'required' => 'O campo :attribute deve ser informado'
            ]);


            if (isset($request['produtos_id'])) {
                for($idxProduto = 0; $idxProduto < sizeof($request['produtos_id']); $idxProduto++){

                    if (!isset($request['quantidade']) || $request['quantidade'][$idxProduto] == 0 || $request['quantidade'][$idxProduto] == "") {
                        return redirect()->to(route('pedido.create'))->withErrors(['Informe quantidade para todos os produtos!']);
                    }
                }

                $pedido = Pedido::find($numero);
                $pedido->nome_cliente = $request->nome_cliente;
                $pedido->mesa         = $request->mesa;
                $pedido->forma_pagamento_id = $request->forma_pagamento_id;
                $pedido->save();
                $pedido->produtos()->detach();
                for($idxProduto = 0; $idxProduto < sizeof($request['produtos_id']); $idxProduto++){
                    $preco = Produto::find($request['produtos_id'][$idxProduto])->preco;

                    $pedido->produtos()->attach(
                    $request['produtos_id'][$idxProduto],
                    [
                        'quantidade' => $request['quantidade'][$idxProduto],
                        'preco' => $preco
                    ]
                    );
                }
            } else {
                return redirect()->to(route('pedido.create'))->withErrors(['Informe no mínimo um produto!']);
            }

            $request->session()->flash('message', 'Pedido alterado com suceso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('pedido.index'));
    }

    public function destroy($numero)
    {
        $pedido = Pedido::find($numero);
        $pedido->delete();
        return redirect()->to(route('pedido.index'))->with('message', 'Pedido deletado com sucesso!');
    }
}
