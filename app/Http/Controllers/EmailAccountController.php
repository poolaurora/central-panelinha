<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailAccount;

class EmailAccountController extends Controller
{

    public function create()
    {
        return view('email');
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

    public function destroy(EmailAccount $emailAccount)
    {
        $emailAccount->delete();
        return redirect()->route('email_accounts.index')->with('success', 'Conta de e-mail removida com sucesso.');
    }
}
