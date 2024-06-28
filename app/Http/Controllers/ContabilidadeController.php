<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transacao;
use App\Models\TransacaoAd;

class ContabilidadeController extends Controller
{
    public function view(){
        $historico = Transacao::orderBy('created_at', 'desc')->paginate(25);
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

    public function viewads(){
        $historico = TransacaoAd::orderBy('created_at', 'desc')->paginate(25);
        $saldoAtual = TransacaoAd::sum('valor');

        return view('contabilidadeAds', compact('historico', 'saldoAtual'));
    }

    public function storeAds(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'valor' => 'required|numeric',
            'descricao' => 'required|string|max:255',
        ]);

        $valor = $request->tipo === 'saida' ? -$request->valor : $request->valor;

        TransacaoAd::create([
            'tipo' => $request->tipo,
            'valor' => $valor,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('contabilidade.ads.view')->with('success', 'Transação adicionada com sucesso!');
    }
}
