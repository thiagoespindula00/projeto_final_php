<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacao;

class OperacaoController extends Controller
{
    public function index()
    {
        $operacoes = Operacao::all();
        return view('operacao.index', compact('operacoes'));
    }
    
    public function create() {
        return view('operacao.create');
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
            Operacao::create($dados);
            $request->session()->flash('message', 'Operação cadastrada com sucesso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('operacao.index'));
    }

    public function edit($id)
    {
        $operacao = Operacao::find($id);
        return view('operacao.edit', compact('operacao'));
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
            
            $operacao = Operacao::find($id);
            $operacao->codigo    = $request->codigo;
            $operacao->descricao = $request->descricao;
            $operacao->save();

            $request->session()->flash('message', 'Operação alterada com suceso!');
        }
        else
        {
            $request->session()->flash('message', 'Operação cancelada pelo usuário!');
        }

        return redirect()->to(route('operacao.index'));
    }

    public function destroy($id)
    {
        $operacao = Operacao::find($id);
        $operacao->delete();
        return redirect()->to(route('operacao.index'))->with('message', 'Operação deletada com sucesso!');
    }
}
