<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Claim;
use App\Models\Client;


class ClaimController extends Controller
{
    public function index()
    {
        $claims = Claim::all();

        return view('claims.index', compact('claims'));
    }

    public function create()
    {
        return view('claims.create');
    }

    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'client_id' => 'required',
        'incident_date' => 'required|date',
        'incident_details' => 'required',
        'proof' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
    ]);

    // Get the selected client
    $client = Client::findOrFail($validatedData['client_id']);

    // Create a new claim instance
    $claim = new Claim();
    $claim->client_id = $validatedData['client_id']; // Use the validated data instead of input directly from request
    $claim->claim_amount = $request->input('claim_amount');
    $claim->incident_date = $validatedData['incident_date']; // Use the validated data instead of input directly from request
    $claim->policy_type = $client->policy_type;
    $claim->incident_details = $validatedData['incident_details']; // Use the validated data instead of input directly from request
    if ($request->hasFile('proof')) {
        $proof = $request->file('proof');
        $proofPath = $proof->store('proofs');
        $claim->proof = $proofPath;
    }
    
    $claim->approval_status = 'pending';

    // Save the claim
    $claim->save();

    // Redirect or perform any other actions after saving the claim

    // Example: Redirect to a success page
    return redirect()->route('admin.claims');
}
public function downloadProof(Claim $claim)
{
    $filePath = storage_path('app/' . $claim->proof);
    return response()->download($filePath);
}



    public function show(Claim $claim)
    {
        return view('claims.show', compact('claim'));
    }

    public function edit(Claim $claim)
    {
        return view('claims.edit', compact('claim'));
    }

    public function update(Request $request, Claim $claim)
    {
        $request->validate([
            'policy_type' => 'required',
            'incident_details' => 'required',
            'client_id' => 'required',
            'proof' => 'required',
            'claim_amount' => 'required',
        ]);

        $claim->update($request->all());

        return redirect()->route('claims.index')->with('success', 'Claim updated successfully.');
    }

    public function destroy(Claim $claim)
    {
        $claim->delete();

        return redirect()->route('claims.index')->with('success', 'Claim deleted successfully.');
    }
}
