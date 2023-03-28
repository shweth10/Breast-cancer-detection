<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsDoctorVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::guard('doctor')->user()->email_verified){
            Auth::guard('doctor')->logout();
            return redirect()->route('doctor.login')->with('fail','You need to confirm your account, we have sent you an activation link, please check your email.');
        }
        return $next($request);
    }
}
