<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class AdminForgotPasswordController extends Controller
{
use SendsPasswordResetEmails;

/**
* Create a new controller instance.
*
* @return void
*/
public function __construct()
{
$this->middleware('guest:admin');
}

public function showLinkRequestForm()
{
return view('auth.passwords.admin-email');
}

//defining which password broker to use, in our case its the admins
protected function broker()
{
return Password::broker('admins');
}
}