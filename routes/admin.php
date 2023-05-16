<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;

Route::prefix('admin')->name('admin.')->group(function(){


    // Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    // Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    // Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    // Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

       
    Route::middleware(['guest:admin','PreventBackHistory'])->group(function(){
          Route::view('/login','dashboard.admin.login')->name('login');
          Route::post('/check',[AdminController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin','PreventBackHistory'])->group(function(){
        Route::view('/','dashboard.admin.home')->name('home');
        Route::view('/home','dashboard.admin.home')->name('home');
        Route::view('/claims','dashboard.admin.claims')->name('claims');
        Route::view('/home','dashboard.admin.home')->name('home');
        Route::post('/logout',[AdminController::class,'logout'])->name('logout');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });

});
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
Route::post('/claims', [App\Http\Controllers\ClaimController::class, 'store'])->name('claim.store');
Route::get('/claims/download/{claim}', [App\Http\Controllers\ClaimController::class, 'downloadProof'])->name('claims.download');
Route::put('/claims/{claim}/approve', [App\Http\Controllers\ClaimController::class, 'approve'])->name('admin.claims.approve');
Route::put('/claims/{claim}/reject', [App\Http\Controllers\ClaimController::class, 'reject'])->name('admin.claims.reject');



