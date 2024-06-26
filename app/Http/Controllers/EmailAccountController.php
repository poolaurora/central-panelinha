<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailAccount;

class EmailAccountController extends Controller
{

    public function create()
    {

        $emailAccounts = EmailAccount::all();

        return view('email', compact('emailAccounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'imap_host' => 'required',
            'imap_port' => 'required|integer',
            'imap_encryption' => 'required',
            'imap_validate_cert' => 'required|boolean',
        ]);

        EmailAccount::create($request->all());

        return redirect()->route('email.view')->with('success', 'Conta de e-mail adicionada com sucesso.');
    }

    public function destroy($id)
    {
        $email = EmailAccount::find($id);

        $email->delete();

        return redirect()->route('email.view')->with('success', 'Conta de e-mail excluída com sucesso.');
    }
}
