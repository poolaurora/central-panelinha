<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PixController;
use App\Http\Controllers\ContabilidadeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\EmailAccountController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\CnpjController;
use App\Http\Controllers\CrawlerController;
use App\Http\Controllers\SicoobExtratoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::get('/dashboard/pix', [PixController::class, 'view'])->name('pix.view');
    Route::post('/generate-pix', [PixController::class, 'generate'])->name('generate-pix');
    Route::get('/dashboard/qr-code/{id}', [PixController::class, 'qrcode'])->name('pix.qrcode');
    Route::post('/create-pix', [PixController::class, 'store'])->name('create-pix');

    Route::get('/dashboard/contabilidade', [ContabilidadeController::class, 'view'])->name('contabilidade.view');
    Route::post('/contabilidade', [ContabilidadeController::class, 'store'])->name('contabilidade.store');

    Route::get('/dashboard/contabilidade/ads', [ContabilidadeController::class, 'viewads'])->name('contabilidade.ads.view');
    Route::post('/contabilidade/ads', [ContabilidadeController::class, 'storeAds'])->name('contabilidade.ads.store');

    Route::get('/dashboard/email', [EmailAccountController::class, 'create'])->name('email.view');
    Route::post('/dashboard/email/create', [EmailAccountController::class, 'store'])->name('email.store');
    Route::delete('/dashboard/email/destroy/{id}', [EmailAccountController::class, 'destroy'])->name('email.destroy');

    Route::get('/dashboard/payments', [PaymentsController::class, 'view'])->name('payments.view');
    Route::get('/dashboard/payments/store', [PaymentsController::class, 'storeView'])->name('payments.store');
    Route::get('/dashboard/payments/index', [PaymentsController::class, 'index'])->name('payments.index');
    Route::get('/dashboard/payments/show/{empresa}', [PaymentsController::class, 'show'])->name('payments.show');
    Route::get('/dashboard/payments/subconta', [PaymentsController::class, 'index_subconta'])->name('payments.index.subconta');



    
    /*
    
    Route::post('/dashboard/payments/create', [PaymentsController::class, 'generatePaymentLink'])->name('payments.create');
    Route::post('/dashboard/company/store', [PaymentsController::class, 'store'])->name('payments.store');

    */

    Route::get('/dashboard/cnpj', [CnpjController::class, 'index'])->name('cnpj.index');
    Route::get('/dashboard/cnpj/consulta', [CnpjController::class, 'view'])->name('cnpj.consulta.cnpj');
    Route::post('/import-excel', [CnpjController::class, 'import'])->name('cnpj.import.excel');
    Route::post('/clear-cnpjs', [CnpjController::class, 'clearCnpjs'])->name('cnpj.clear');

    Route::get('/view/fatura', [InvoiceController::class, 'view'])->name('faturas.view');
    Route::get('/dashboard/pdf', [InvoiceController::class, 'index'])->name('pdf.index');
    Route::get('/dashboard/pdf/extrato', [InvoiceController::class, 'indexExtrato'])->name('pdf.extrato');
    Route::post('/dashboard/pdf/extrato/gerar/santander', [InvoiceController::class, 'generate'])->name('pdf.santander.gerar');
    Route::post('/dashboard/pdf/extrato/gerar/sicoob', [SicoobExtratoController::class, 'generate'])->name('pdf.sicoob.gerar');
    Route::get('/dashboard/pdf/itau', [InvoiceController::class, 'itau'])->name('pdf.itau');


});

require __DIR__.'/auth.php';
