<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\tax\TaxController;
use App\Http\Controllers\admin\bank\BankController;
use App\Http\Controllers\admin\wage\WageController;
use App\Http\Controllers\frontend\home\HomeController;
use App\Http\Controllers\admin\charity\CharityController;
use App\Http\Controllers\admin\mission\MissionController;
use App\Http\Controllers\admin\payment\PaymentController;
use App\Http\Controllers\admin\statement\StatementController;

Route::get('/', [HomeController::class, 'index'])->name('home.page');

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
// ============================================= Wage Controller =============================================
Route::controller(WageController::class)->prefix('wage')->group(function() {
    Route::get('/', 'index')->name('admin.wage.index');
    Route::get('/create', 'create')->name('admin.wage.create');
    Route::post('/store', 'store')->name('admin.wage.store');
    Route::get('/edit/{wageId}', 'edit')->name('admin.wage.edit');
    Route::put('/{wageId}/update', 'update')->name('admin.wage.update');
    Route::post('/delete/{wageId}', 'delete')->name('admin.wage.delete');
});
// ============================================= Payment Controller =============================================
Route::controller(PaymentController::class)->prefix('payment')->group(function() {
    Route::get('/', 'index')->name('admin.payment.index');
    Route::get('/create', 'create')->name('admin.payment.create');
    Route::post('/store', 'store')->name('admin.payment.store');
    Route::get('/edit/{paymentId}', 'edit')->name('admin.payment.edit');
    Route::put('/{paymentId}/update', 'update')->name('admin.payment.update');
    Route::post('/delete/{paymentId}', 'delete')->name('admin.payment.delete');
});
// ============================================= Tax Controller =============================================
Route::controller(TaxController::class)->prefix('tax')->group(function() {
    Route::get('/', 'index')->name('admin.tax.index');
    Route::get('/create', 'create')->name('admin.tax.create');
    Route::post('/store', 'store')->name('admin.tax.store');
    Route::get('/edit/{taxId}', 'edit')->name('admin.tax.edit');
    Route::put('/{taxId}/update', 'update')->name('admin.tax.update');
    Route::post('/delete/{taxId}', 'delete')->name('admin.tax.delete');
});
// ============================================= Charity Controller =============================================
Route::controller(CharityController::class)->prefix('charity')->group(function() {
    Route::get('/', 'index')->name('admin.charity.index');
    Route::get('/create', 'create')->name('admin.charity.create');
    Route::post('/store', 'store')->name('admin.charity.store');
    Route::get('/edit/{charityId}', 'edit')->name('admin.charity.edit');
    Route::put('/{charityId}/update', 'update')->name('admin.charity.update');
    Route::post('/delete/{charityId}', 'delete')->name('admin.charity.delete');
});
// ============================================= Mission Controller =============================================
Route::controller(MissionController::class)->prefix('mission')->group(function() {
    Route::get('/', 'index')->name('admin.mission.index');
    Route::get('/create', 'create')->name('admin.mission.create');
    Route::post('/store', 'store')->name('admin.mission.store');
    Route::get('/edit/{missionId}', 'edit')->name('admin.mission.edit');
    Route::put('/{missionId}/update', 'update')->name('admin.mission.update');
    Route::post('/delete/{missionId}', 'delete')->name('admin.mission.delete');
});
// ============================================= Statement Controller =============================================
Route::controller(StatementController::class)->prefix('statement')->group(function() {
    Route::get('/', 'index')->name('admin.statement.index');
    Route::get('/create', 'create')->name('admin.statement.create');
    Route::post('/store', 'store')->name('admin.statement.store');
    Route::get('/edit/{statementId}', 'edit')->name('admin.statement.edit');
    Route::put('/{statementId}/update', 'update')->name('admin.statement.update');
    Route::post('/delete/{statementId}', 'delete')->name('admin.statement.delete');
});
require __DIR__.'/auth.php';
