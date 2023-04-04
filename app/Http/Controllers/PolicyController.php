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

    public function store(Request $request)
    {
        $policy = new Policy();
        $policy->policy_type = $request->input('policy_type');
        $policy->coverage_amount = $request->input('coverage_amount');
        $policy->premium_amount = $request->input('premium_amount');
        $policy->policy_duration = $request->input('policy_duration');
        $policy->Insurer_id = auth()->user()->id;
        $policy->save();

        return redirect()->route('user.policies');
    }

}
