<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PixController;
use App\Http\Controllers\ContabilidadeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\EmailAccountController;
use App\Http\Controllers\PaymentsController;
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
    Route::post('/dashboard/payments/create', [PaymentsController::class, 'generatePaymentLink'])->name('payments.create');
    Route::post('/dashboard/company/store', [PaymentsController::class, 'store'])->name('payments.store');

});

require __DIR__.'/auth.php';
