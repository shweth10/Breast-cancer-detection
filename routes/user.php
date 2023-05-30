<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PaymentController;



Route::prefix('user')->name('user.')->group(function(){
  
    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
          Route::view('/login','dashboard.user.login')->name('login');
          Route::view('/register','dashboard.user.register')->name('register');
          Route::post('/create',[UserController::class,'create'])->name('create');
          Route::post('/check',[UserController::class,'check'])->name('check');
          Route::get('/verify',[UserController::class,'verify'])->name('verify');

          Route::get('/password/forgot',[UserController::class,'showForgotForm'])->name('forgot.password.form');
          Route::post('/password/forgot',[UserController::class,'sendResetLink'])->name('forgot.password.link');
          Route::get('/password/reset/{token}',[UserController::class,'showResetForm'])->name('reset.password.form');
          Route::post('/password/reset',[UserController::class,'resetPassword'])->name('reset.password');
    });

    Route::middleware(['auth:web','is_user_verify_email','PreventBackHistory'])->group(function(){
          Route::view('/','dashboard.user.home')->name('home');
          Route::view('/claims','dashboard.user.claims')->name('claims');
          Route::view('/policies','dashboard.user.policies')->name('policies');
          Route::view('/clients','dashboard.user.clients')->name('clients');
          Route::view('/payments','dashboard.user.payments')->name('payments');
          Route::view('/home','dashboard.user.home')->name('home');
          Route::post('/logout',[UserController::class,'logout'])->name('logout');
          Route::get('/add-new',[UserController::class,'add'])->name('add');
    });

});

Route::post('/policy', [App\Http\Controllers\PolicyController::class, 'store'])->name('policy.store');
Route::post('/client', [App\Http\Controllers\ClientController::class, 'store'])->name('client.store');

Route::post('/notify-client/{client}', [App\Http\Controllers\ClientController::class, 'notify'])->name('notify.client');




Route::delete('/policies/{id}', [App\Http\Controllers\PolicyController::class, 'destroy'])->name('policy.destroy');
Route::delete('/clients/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('client.destroy');
Route::put('/policies/{id}', [App\Http\Controllers\PolicyController::class, 'update'])->name('policy.update');
Route::put('/clients/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('client.update');

Route::post('/clients/{id}/renew', [App\Http\Controllers\ClientController::class, 'renewPolicy'])->name('renew.policy');

Route::get('/clients/{id}/report', [App\Http\Controllers\ClientController::class, 'generateReport'])->name('client.report');
Route::get('/policy/{id}/report', [App\Http\Controllers\PolicyController::class, 'generateReport'])->name('policy.report');
Route::get('/payments/report', [App\Http\Controllers\PaymentController::class, 'generatePaymentsReport'])->name('payments.report');
Route::get('/payments/{id}/report', [App\Http\Controllers\ClientController::class, 'generatePReport'])->name('premium.report');

Route::post('/claims', [App\Http\Controllers\ClaimController::class, 'store'])->name('claim.store');
Route::get('/claims/download/{claim}', [App\Http\Controllers\ClaimController::class, 'downloadProof'])->name('claims.download');
Route::put('/claims/{claim}/approve', [App\Http\Controllers\ClaimController::class, 'approve'])->name('user.claims.approve');
Route::put('/claims/{claim}/reject', [App\Http\Controllers\ClaimController::class, 'reject'])->name('user.claims.reject');



