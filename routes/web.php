<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PixController;
use App\Http\Controllers\ContabilidadeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\EmailAccountController;
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

    Route::get('/dashboard/contabilidade', [ContabilidadeController::class, 'view'])->name('contabilidade.view');
    Route::post('/contabilidade', [ContabilidadeController::class, 'store'])->name('contabilidade.store');

    Route::get('/dashboard/faturas', [InvoiceController::class, 'view'])->name('faturas.view');

    Route::get('/dashboard/email', [EmailAccountController::class, 'create'])->name('email.view');
    Route::post('/dashboard/email/create', [EmailAccountController::class, 'store'])->name('email.store');
    Route::delete('/dashboard/email/destroy/{id}', [EmailAccountController::class, 'destroy'])->name('email.destroy');


});

require __DIR__.'/auth.php';
