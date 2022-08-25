<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProduto;

class TipoProdutoController extends Controller
{
    public function index()
    {
        $tipos_produto = TipoProduto::all();
        return view('tipo_produto.index', compact('tipos_produto'));
    }
    
    public function create() {
        return view('tipo_produto.create');
    }

    public function store(Request $request)
    {   
        if (! $request->has('cancel'))
        {
            $this->validate($request, [
                'codigo' => 'required',
                'descricao' => 'required'
            ], [
                'required' => 'O campo :attribute deve ser informado'
            ]);

            $dados = $request->all();
            TipoProduto::create($dados);
            $request->session()->flash('message', 'Tipo de produto cadastrado com sucesso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('tipo_produto.index'));
    }

    public function edit($id)
    {
        $tipo_produto = TipoProduto::find($id);
        return view('tipo_produto.edit', compact('tipo_produto'));
    }

    public function update(Request $request, $id)
    {
        if (!$request->has('cancel'))
        {
            $this->validate($request, [
                'codigo' => 'required',
                'descricao' => 'required'
            ], [
                'required' => 'O campo :attribute deve ser informado'
            ]);
            
            $tipo_produto = TipoProduto::find($id);
            $tipo_produto->codigo    = $request->codigo;
            $tipo_produto->descricao = $request->descricao;
            $tipo_produto->save();

            $request->session()->flash('message', 'Tipo de produto alterado com suceso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('tipo_produto.index'));
    }

    public function destroy($id)
    {
        $tipo_produto = TipoProduto::find($id);
        $tipo_produto->delete();
        return redirect()->to(route('tipo_produto.index'))->with('message', 'Tipo de produto deletado com sucesso!');
    }
}
