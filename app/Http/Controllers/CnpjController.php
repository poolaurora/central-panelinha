<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CnpjImport;
use App\Models\Cnpj;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class CnpjController extends Controller
{
    public function index(){

        return view('cnpj.index');
    }

    public function view(){

        return view('cnpj.consulta-cnpj');
    }

    public function import(Request $request)
{
    // Valida a entrada do textarea
    $request->validate([
        'cnpj_list' => 'required',
    ]);

    $cnpjList = $request->input('cnpj_list');

    // Processa a lista de CNPJ
    $cnpjArray = array_map('trim', explode("\n", $cnpjList));

    try {
        // Aqui você pode adicionar o código para processar cada CNPJ na lista
        foreach ($cnpjArray as $cnpj) {
            // Verifique se o CNPJ é válido
            if (!empty($cnpj)) {
                // Salvar no banco de dados
                Cnpj::create(['cnpj' => $cnpj, 'status' => 'pendente']);
            }
        }

        return back()->with('success', 'CNPJs importados com sucesso.');
    } catch (\Exception $e) {
        // Log do erro com a mensagem de exceção
        Log::error('Erro ao processar a lista de CNPJ: ' . $e->getMessage());
        return back()->with('error', 'Ocorreu um erro ao processar a lista de CNPJ.');
    }
}
    


    public function clearCnpjs(Request $request)
    {
        try {
            Cnpj::truncate();
            return redirect()->back()->with('success', 'Todos os registros de CNPJ foram limpos.');
        } catch (\Exception $e) {
            Log::error('Erro ao limpar registros de CNPJ: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocorreu um erro ao limpar os registros de CNPJ.');
        }
    }
}
