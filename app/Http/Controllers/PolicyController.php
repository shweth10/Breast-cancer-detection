<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Policy;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class PolicyController extends Controller
{
    public function getPoliciesForCurrentUser()
    {
        $user = Auth::user();
        $policies = $user->policies;

        return view('dashboard.user.policies', compact('policies'));
    }
}
