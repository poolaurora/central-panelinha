<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;

class ContabilidadeController extends Controller
{
    public function view(){
        $historico = Transacao::orderBy('created_at', 'desc')->get();
        $saldoAtual = Transacao::sum('valor');

        return view('contabilidade', compact('historico', 'saldoAtual'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'valor' => 'required|numeric',
            'descricao' => 'required|string|max:255',
        ]);

        $valor = $request->tipo === 'saida' ? -$request->valor : $request->valor;

        Transacao::create([
            'tipo' => $request->tipo,
            'valor' => $valor,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('contabilidade.view')->with('success', 'Transação adicionada com sucesso!');
    }
}
