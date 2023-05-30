@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Claims | Client')
@section('content')
<div class="relative max-w-7xl mx-auto">
    <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden lg:max-w-none lg:flex">
        <div class="flex-1 px-6 py-8 lg:p-12 bg-gray-600">
            <h3 class="text-2xl font-extrabold text-white sm:text-3xl">Claims</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-3">
    </div>
    @php
    $clients = App\Models\Client::all();
    $claims = App\Models\Claim::all();
    $policies=App\Models\Policy::all();
    $payments=App\Models\Payment::all();
    @endphp
    
    
    <table class="table">
    <thead>
        <tr>
            <th>Client</th>
            <th>Excess</th>
            <th>Policy Type</th>
            <th>Incident Details</th>
            <th>Claim Amount</th>
            <th>Claim Date</th>
            <th>Proof</th>
            <th>Approval Status</th>

        </tr>
    </thead>
    <tbody>
    @foreach($claims as $claim)
        @foreach ($clients as $client)
            @if ($client->id == $claim->client_id && $client->client_fname == Auth::user()->name)
                <tr>
                    <td>{{ $client->client_fname }}</td>
                    <td>${{ number_format($client->excess_amount, 2, '.', ',') }}</td>
                    <td>{{ $claim->policy_type }}</td>
                    <td>
                        @if(strlen($claim->incident_details) > 20)
                            {{ substr($claim->incident_details, 0, 20) }}...
                            <a href="#" data-toggle="modal" data-target="#coverageInfoModal{{ $claim->id }}">Read more</a>
                            <div class="modal fade" id="coverageInfoModal{{ $claim->id }}" tabindex="-1" role="dialog" aria-labelledby="coverageInfoModal{{ $claim->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="coverageInfoModal{{ $claim->id }}Label">Incident Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $claim->incident_details }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{ $claim->incident_details }}
                        @endif
                    </td>
                    <td>${{ number_format($claim->claim_amount, 2, '.', ',') }}</td>
                    <td>{{ $claim->incident_date }}</td>
                    <td>
                        @if ($claim->proof)
                            <a href="{{ route('claims.download', $claim) }}"><i class="nav-icon fas fa-download"></i></a>
                        @else
                            No proof available
                        @endif
                    </td>
                    <td>
                        @if ($claim->approval_status == 'pending')
                            <span class="bg-yellow-500 px-2 py-0.5 font-semibold text-sm rounded-sm text-white">Pending</span>
                        @elseif ($claim->approval_status == 'approved')
                            <span class="bg-green-500 px-2 py-0.5 font-semibold text-sm rounded-sm text-white">Approved</span>
                        @elseif ($claim->approval_status == 'rejected')
                            <span class="bg-red-500 px-2 py-0.5 font-semibold text-sm rounded-sm text-white">Rejected</span>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    @endforeach
</tbody>
</table>


    </div>

                    <!-- Add Claim Modal -->
    <div class="modal fade" id="addClaimModal" tabindex="-1" role="dialog" aria-labelledby="addClaimModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClaimModalLabel">Add Claim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form method="POST" id="signUpForm" class="p-12 shadow-md rounded-2xl bg-white mx-auto border-solid border-2 border-gray-100 mb-8" action="{{ route('claim.store') }}" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label for="client_id">Select Client</label>
                            <select class="form-control" id="client_id" name="client_id" required>
                                @if ($policies->isEmpty())
                                <option value="">Policy not found, Add policy type first!</option>
                                @else
                                <option value="">Client List</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_fname }}- {{ $client->policy_type }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="incident_date">Incident Date</label>
                        <input type="text" name="incident_date" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"  id="incident_date" placeholder="YYYY-MM-DD" required pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD">
                        <div class="invalid-feedback">Please enter a valid date in the format YYYY-MM-DD</div>
                        </div>

                        
                        <label for="claim_amount">Claim Amount</label>
                
                        <div class="mb-6">
                        <input type="number" placeholder="claim amount $" required autocomplete="off" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" name="claim_amount" class="form-claim_amount" id="claim_amount" required>

                        </div>
                        <div class="mb-6">
                        <input type="text" placeholder= "Enter Incident Details" required autocomplete="off" name="incident_details" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'"  id="incident_details" required>
                        </div>

                        <div class="py-20 bg-white px-2">
                            <label for="incident_date">Proof of Claim</label>
                            <div class="max-w-md mx-auto rounded-lg overflow-hidden md:max-w-xl">
                                <div class="md:flex">
                                    <div class="w-full p-3">
                                        <div class="relative border-dotted h-48 rounded-lg border-dashed border-2 border-blue-700 bg-gray-100 flex justify-center items-center">
                                            <div class="absolute">
                                                <div class="flex flex-col items-center">
                                                    <i class="fa fa-folder-open fa-4x text-blue-700"></i>
                                                    <span id="file-label">Attach your files here</span>
                                                </div>
                                            </div>
                                            <input type="file" class="h-full w-full opacity-0" name="proof" id="proof" onchange="updateFileName()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                
                <button type="submit" class="flex-1 border border-transparent focus:outline-none p-3 rounded-md text-center text-white bg-indigo-600 hover:bg-indigo-700 text-lg">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



            </div>
        </div>
    </div>
@endsection