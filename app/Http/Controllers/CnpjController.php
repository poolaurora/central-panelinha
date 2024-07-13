<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CnpjImport;
use App\Models\Cnpj;
use Maatwebsite\Excel\Facades\Excel;

class CnpjController extends Controller
{
    public function index(){

        return view('cnpj.index');
    }

    public function view(){

        return view('cnpj.consulta-cnpj');
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new CnpjImport, $request->file('excel_file'));

        return back()->with('success', 'Arquivo importado com sucesso!');
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
