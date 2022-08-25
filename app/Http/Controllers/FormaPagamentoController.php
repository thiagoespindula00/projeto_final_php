<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormaPagamento;

class FormaPagamentoController extends Controller
{
    public function index()
    {
        $formas_pagamento = FormaPagamento::all();
        return view('forma_pagamento.index', compact('formas_pagamento'));
    }
    
    public function create() {
        return view('forma_pagamento.create');
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
            FormaPagamento::create($dados);
            $request->session()->flash('message', 'Forma de pagamento cadastrada com sucesso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('forma_pagamento.index'));
    }

    public function edit($id)
    {
        $forma_pagamento = FormaPagamento::find($id);
        return view('forma_pagamento.edit', compact('forma_pagamento'));
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
            
            $forma_pagamento = FormaPagamento::find($id);
            $forma_pagamento->codigo    = $request->codigo;
            $forma_pagamento->descricao = $request->descricao;
            $forma_pagamento->save();

            $request->session()->flash('message', 'Forma de pagamento alterado com suceso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('forma_pagamento.index'));
    }

    public function destroy($id)
    {
        $forma_pagamento = FormaPagamento::find($id);
        $forma_pagamento->delete();
        return redirect()->to(route('forma_pagamento.index'))->with('message', 'Forma de pagamento deletado com sucesso!');
    }
}
