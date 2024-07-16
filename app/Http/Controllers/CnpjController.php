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
        Log::info('Método import chamado.');

        // Valida o arquivo
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            Log::info('Arquivo recebido: ' . $file->getClientOriginalName());
            Log::info('Caminho temporário do arquivo: ' . $file->getPathname());

            try {
                Excel::import(new CnpjImport, $file);
                Log::info('Importação concluída com sucesso.');

                return back()->with('success', 'CNPJs importados com sucesso.');
            } catch (\Exception $e) {
                Log::error('Erro ao importar arquivo Excel: ' . $e->getMessage());

                return back()->with('error', 'Ocorreu um erro ao importar o arquivo Excel.');
            }
        } else {
            Log::error('Nenhum arquivo foi recebido.');
            return back()->with('error', 'Nenhum arquivo foi recebido.');
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
