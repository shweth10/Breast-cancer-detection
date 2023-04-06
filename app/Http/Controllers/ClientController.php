<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Client;
use App\Models\VerifyUser;
use App\Models\Policy;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
class ClientController extends Controller
{

    public function add()
    {
    $policies = Policy::all();

    return view('dashboard.user.add', compact('policies'));
    }


    public function generateReport($id)
    {
        $client = Client::findOrFail($id);

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');

        $pdf = new Dompdf($options);

        $html = view('dashboard.user.client-report', compact('client'));

        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream($client->client_fname . '-report.pdf');
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->client_fname = $request->input('client_fname');
        $client->Age = $request->input('Age');
        $client->driving_license_number = $request->input('driving_license_number');
        $client->client_email = $request->input('client_email');
        $client->phone_number = $request->input('phone_number');
        $client->vehicle_model = $request->input('vehicle_model');
        $client->vehicle_registration = $request->input('vehicle_registration');

        $client->save();

        return redirect()->route('user.clients')->with('success', 'client has been updated');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('dashboard.user.edit-client', compact('client'));
    }

    public function getClientForCurrentUser()
    {
        $user = Auth::user();
        $clients = $user->clients;

        return view('dashboard.user.clients', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'policy_start_date' => 'required|date_format:Y-m-d',
        ]);

        
        $policy = Policy::findOrFail($request->input('policy_id'));

        $client = new Client();
        $client->client_fname = $request->input('client_fname');
        $client->Age = $request->input('Age');
        $client->driving_license_number = $request->input('driving_license_number');
        $client->client_email = $request->input('client_email');
        $client->phone_number = $request->input('phone_number');
        $client->vehicle_model = $request->input('vehicle_model');
        $client->policy_id = $policy->id;
        $client->policy_type = $policy->policy_type; // retrieve policy_type from policies table
        $client->policy_duration = $policy->policy_duration; // retrieve duration from policies table
        $client->coverage_amount = $policy->coverage_amount; // retrieve duration from policies table
        $client->premium_amount = $policy->premium_amount; // retrieve duration from policies table
        $client->payment_period = $policy->payment_period; // retrieve duration from policies table
        $client->vehicle_registration = $request->input('vehicle_registration');
        $client->policy_start_date = $request->input('policy_start_date');
        $client->Insurer_id = auth()->user()->id;
        $client->premium_due_date = $client->calculatePremiumDueDate();

        
        $client->save();

        return redirect()->route('user.clients');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('user.clients')->with('success', 'client has been deleted');
    }
}
