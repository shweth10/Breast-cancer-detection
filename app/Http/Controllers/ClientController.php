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
use Illuminate\Support\Facades\Mail;
use App\Mail\PolicyExpiredNotification;
use App\Mail\CancelRenewalNotification;
use App\Models\Claim;


class ClientController extends Controller
{
    public function cancelRenewalRequest($id)
{
    $client = Client::find($id);

    // Set policy_end_date to the last day of the current year
    $client->policy_end_date = Carbon::now()->endOfYear();
    $client->save();

    return redirect()->back()->with('success', 'Renewal canceled successfully.');
}
    public function cancelRenewal(Request $request)
{
    $clientId = $request->client_id;
    $client = Client::find($clientId);

    if (!$client) {
        // Handle the case when the client is not found
        return redirect()->back()->with('error', 'Client not found.');
    }

    Mail::to('shweth34@gmail.com')->send(new CancelRenewalNotification($client));

    // Perform any additional actions, such as updating the client's renewal status

    return redirect()->back()->with('success', 'Renewal cancellation request sent.');
}
public function notify(Client $client)
{
    $emailData = [
        'client' => $client,
    ];

    Mail::to($client->client_email)->send(new PolicyExpiredNotification($emailData));

    return redirect()->back()->with('successful', 'Notification email sent.');
}
public function renewPolicy($id)
{
    $client = Client::findOrFail($id);

    // Check if the client is present in the claims table
    $claim = Claim::where('client_id', $client->id)->first();

    // Apply policy amount changes based on client presence and approval status in claims table
    if ($claim) {
        if ($claim->approval_status === 'approved') {
            // Increase premium_amount by 10%
            $client->premium_amount += $client->premium_amount * 0.1;
        } else {
            // Decrease premium_amount by 10%
            $client->premium_amount -= $client->premium_amount * 0.1;
        }
    } else {
        // Decrease premium_amount by 10%
        $client->premium_amount -= $client->premium_amount * 0.1;
    }

    // Add one more year to the policy_end_date
    $policyEndDate = Carbon::parse($client->policy_end_date);
    $client->policy_end_date = $policyEndDate->addYear();

    // Set premium_due_date to current date
    $client->premium_due_date = Carbon::now()->format('Y-m-d');

    $client->save();

    return redirect()->back()->with('success', 'Policy has been renewed.');
}





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
    public function generatePReport($id)
    {
        $client = Client::findOrFail($id);

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');

        $pdf = new Dompdf($options);

        $html = view('dashboard.user.premium-report', compact('client'));

        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream($client->client_fname . '-report.pdf');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('dashboard.user.edit-client', compact('client'));
    }

    public function change(Request $request, $id)
    {
            $client = Client::findOrFail($id);
            $policy = Policy::where('id', $client->policy_id)->first(); // get the policy associated with the client
            $policyRate = $policy->coverage_rate; // retrieve coverage rate from policies table
            
            $client->client_fname = $request->input('client_fname');
            $client->Age = $request->input('Age');
            $client->driving_license_number = $request->input('driving_license_number');
            $client->client_email = $request->input('client_email');
            $client->phone_number = $request->input('phone_number');
            $client->vehicle_model = $request->input('vehicle_model');
            $client->policy_id = $client->policy_id;
            $client->policy_type = $client->policy_type; // retrieve policy_type from policies table
            $client->policy_duration = $client->policy_duration; // retrieve duration from policies table
            $original_coverage_amount = $client->coverage_amount;
            $client->coverage_amount = $request->input('coverage_amount');
            $client->excess_amount = $request->input('excess_amount');
            
            $original_payment_period = $client->payment_period;
            $requested_payment_period = $request->input('payment_period');
    
            // Recalculate premium if the coverage amount has changed
            if ($client->coverage_amount != $original_coverage_amount) {
                $client->premium_amount = ($client->coverage_amount * $policyRate/100) - ($client->excess_amount * $policyRate/100);
                $client->premium_amount -= ($client->excess_amount * $policyRate/100) * ($client->vehicle_model/100);
            }
            $payment_period = $request->input('payment_period');
            if ($payment_period == 'monthly') {
                $client->premium_amount= $client->premium_amount / 12;
            } elseif ($payment_period == 'quarterly') {
                $client->premium_amount = $client->premium_amount / 4;
            }

            // convert premium amount based on requested payment period
            if ($original_payment_period == 'monthly' && $requested_payment_period == 'annually') {
                $client->premium_amount *= 12;
            } elseif ($original_payment_period == 'monthly' && $requested_payment_period == 'quarterly') {
                $client->premium_amount *= 4;
            } elseif ($original_payment_period == 'quarterly' && $requested_payment_period == 'monthly') {
                $client->premium_amount /= 4;
            } elseif ($original_payment_period == 'quarterly' && $requested_payment_period == 'annually') {
                $client->premium_amount *= 3;
            } elseif ($original_payment_period == 'annually' && $requested_payment_period == 'monthly') {
                $client->premium_amount /= 12;
            } elseif ($original_payment_period == 'annually' && $requested_payment_period == 'quarterly') {
                $client->premium_amount /= 4;
            }// update payment period
            $client->payment_period = $requested_payment_period;
    
            $client->vehicle_registration = $request->input('vehicle_registration');
            $client->policy_start_date = $request->input('policy_start_date');
            $client->payment_date = $request->input('policy_start_date');
            $client->premium_due_date = $client->calculatePremiumDueDate();
            $client->policy_end_date;
            $client->save();

    return redirect()->back();
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

    $existingClient = Client::where('client_email', $request->input('client_email'))->first();
    $isExistingClient = false;

    if ($existingClient) {
        $isExistingClient = true;
        $existingClient->premium_amount *= 0.9; // Reduce premium amount by 10% for existing client
        $existingClient->save();
    }

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
    $client->coverage_amount = $request->input('coverage_amount');
    $client->excess_amount = $request->input('excess_amount');
    
    if ($client->Age < 25) {
        $client->excess_amount += 250;
    }

    // Calculate premium_amount using the formula
    $policyRate = $policy->coverage_rate;
    $premium = ($client->coverage_amount * $policyRate / 100) - ($client->excess_amount * $policyRate / 100);
    $premium -= ($client->excess_amount * $policyRate / 100) * ($client->vehicle_model / 100);

    $payment_period = $request->input('payment_period');
    if ($payment_period == 'monthly') {
        $premium = $premium / 12;
    } elseif ($payment_period == 'quarterly') {
        $premium = $premium / 4;
    }
    
    if ($isExistingClient) {
        $premium *= 0.9; // Reduce premium amount by 10% for new client
    }
    
    $client->premium_amount = $premium;

    $client->payment_period = $request->input('payment_period');
    $client->vehicle_registration = $request->input('vehicle_registration');
    $client->policy_start_date = $request->input('policy_start_date');
    $client->payment_date = $request->input('policy_start_date');
    $client->Insurer_id = auth()->user()->id;
    $client->premium_due_date = $client->calculatePremiumDueDate();
    $client->policy_end_date = $client->calculatePolicyEndDate();

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
