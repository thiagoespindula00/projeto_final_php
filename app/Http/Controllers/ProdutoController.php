<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\TipoProduto;
use App\Models\Operacao;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produto.index', compact('produtos'));
    }
    
    public function create() {
        $tipos_produto = TipoProduto::all();
        $operacoes = Operacao::all();
        return view('produto.create', compact('tipos_produto', 'operacoes'));
    }

    public function store(Request $request)
    {
        if (! $request->has('cancel'))
        {
            $this->validate($request, [
                'codigo' => 'required',
                'descricao' => 'required',
                'preco' => 'required'
            ], [
                'required' => 'O campo :attribute deve ser informado'
            ]);
            $produto = new Produto($request->all());
            $produto->save();
            if (isset($request['operacoes_id'])) {
                foreach($request['operacoes_id'] as $operacao_id)
                    $produto->operacoes()->attach($operacao_id);
            }
            $request->session()->flash('message', 'Produto cadastrado com sucesso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('produto.index'));
    }

    public function edit($id)
    {
        $produto = Produto::find($id);
        $tipos_produto = TipoProduto::all();
        $operacoes = Operacao::all();
        return view('produto.edit', compact('produto', 'tipos_produto', 'operacoes'));
    }

    public function update(Request $request, $id)
    {
        if (!$request->has('cancel'))
        {
            $this->validate($request, [
                'codigo' => 'required',
                'descricao' => 'required',
                'preco' => 'required'
            ], [
                'required' => 'O campo :attribute deve ser informado'
            ]);
            
            $produto = Produto::find($id);
            $produto->codigo          = $request->codigo;
            $produto->descricao       = $request->descricao;
            $produto->preco           = $request->preco;
            $produto->tipo_produto_id = $request->tipo_produto_id;
            $produto->operacoes()->detach();
            if (isset($request['operacoes_id'])) {
                foreach($request['operacoes_id'] as $operacao_id)
                    $produto->operacoes()->attach($operacao_id);
            }
            $produto->save();

            $request->session()->flash('message', 'Produto alterado com suceso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('produto.index'));
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->operacoes()->detach();
        $produto->delete();
        return redirect()->to(route('produto.index'))->with('message', 'Produto deletado com sucesso!');
    }
}
