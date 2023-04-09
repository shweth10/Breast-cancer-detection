<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Client;
use App\Models\Policy;
use App\Models\VerifyUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
class PolicyController extends Controller
{
    public function generateReport($id)
    {
        $policy = Policy::findOrFail($id);

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');

        $pdf = new Dompdf($options);

        $html = view('dashboard.user.policy-report', compact('policy'));

        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream($policy->policy_type . '-report.pdf');
    }
    public function update(Request $request, $id)
    {
        $policy = Policy::findOrFail($id);
        $policy->policy_type = $request->input('policy_type');
        $policy->coverage_amount = $request->input('coverage_amount');
        $policy->premium_amount = $request->input('premium_amount');
        $policy->policy_duration = $request->input('policy_duration');
        $policy->coverage_information = $request->input('coverage_information');
        $policy->payment_period = $request->input('payment_period');

        $policy->save();
        $client = Client::where('policy_type',$policy->policy_type)->update(['premium_amount'=>$policy->premium_amount]);


        return redirect()->route('user.policies')->with('success', 'policy has been updated');
    }

    public function edit($id)
    {
        $policy = Policy::findOrFail($id);

        return view('dashboard.user.edit-policy', compact('policy'));
    }

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
        $policy->coverage_information = $request->input('coverage_information');
        $policy->payment_period = $request->input('payment_period');
        $policy->Insurer_id = auth()->user()->id;
        
        $policy->save();

        return redirect()->route('user.policies');
    }

    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();

        return redirect()->route('user.policies')->with('success', 'policy has been deleted');
    }

}
