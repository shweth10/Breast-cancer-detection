<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\DoctorController;

Route::prefix('doctor')->name('doctor.')->group(function(){

    Route::middleware(['guest:doctor','PreventBackHistory'])->group(function(){
         Route::view('/login','dashboard.doctor.login')->name('login');
         Route::view('/register','dashboard.doctor.register')->name('register');
         Route::post('/create',[DoctorController::class,'create'])->name('create');
         Route::post('/check',[DoctorController::class,'check'])->name('check');
         Route::get('/verify',[DoctorController::class,'verify'])->name('verify');

         Route::get('/password/forgot',[DoctorController::class,'showForgotForm'])->name('forgot.password.form');
         Route::post('/password/forgot',[DoctorController::class,'sendResetLink'])->name('forgot.password.link');
         Route::get('/password/reset/{token}',[DoctorController::class,'showResetForm'])->name('reset.password.form');
         Route::post('/password/reset',[DoctorController::class,'resetPassword'])->name('reset.password');
    });

    Route::middleware(['auth:doctor','is_doctor_verify_email','PreventBackHistory'])->group(function(){
         Route::view('/','dashboard.doctor.home')->name('home');
         Route::view('/home','dashboard.doctor.home')->name('home');
         Route::post('logout',[DoctorController::class,'logout'])->name('logout');
    });

});