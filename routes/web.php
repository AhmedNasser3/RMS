<?php

use App\Http\Controllers\admin\bank\BankController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ============================================= Bank Controller =============================================
Route::controller(BankController::class)->prefix('bank')->group(function(){
    Route::get('/','index')->name('admin.bank.index');
    Route::get('/create','create')->name('admin.bank.create');
    Route::post('/store','store')->name('admin.bank.store');
    Route::get('/{bankId}/edit', 'edit')->name('admin.bank.edit');
    Route::put('/{bankId}/update', 'update')->name('admin.bank.update');
    Route::delete('/{bankId}/delete','delete')->name('admin.bank.delete');
});

require __DIR__.'/auth.php';
