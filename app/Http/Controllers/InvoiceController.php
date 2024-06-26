<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;

class InvoiceController extends Controller
{
    public function view(){

        return view('faturas.gerar');
    }

}
