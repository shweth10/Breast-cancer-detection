@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Dashboard | Normal User')
@section('content')

<div class="row">
    <div class="col-md-12 mt-3">
    </div>
    @php
    $clients= App\Models\Client::where('insurer_id', auth()->user()->id)->get();
    $policies=App\Models\Policy::where('insurer_id', auth()->user()->id)->get();
    @endphp
    
    <h3>Client Details</h3>
    <table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Age</th>
            <th>Driving License #</th>
            <th>Vehicle#</th>
            <th>Vehicle Model</th>
            <th>Policy Taken</th>            
            <th>Coverage Amount</th>
            <th>Excess Amount</th>
            <th>Premium Amount</th>
            <th>Payment Period</th>
            <th></th>
            <th>Actions</th>

        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->client_fname }}</td>
            <td>{{ $client->client_email }}</td>
            <td>{{ $client->phone_number }}</td>
            <td>{{ $client->Age }}</td>
            <td>{{ $client->driving_license_number }}</td>
            <td>{{ $client->vehicle_registration }}</td>
            <td>
            @switch($client->vehicle_model)
                @case(99)
                Toyota
                @break
                @case(90)
                Honda
                @break
                @case(85)
                Ford
                @break
                @case(80)
                Nissan
                @break
                @case(75)
                Chevrolet
                @break
                @case(72)
                Hyundai
                @break
                @case(70)
                Kia
                @break
                @default
                Unknown
            @endswitch
            </td> 
            <td>{{ $client->policy_type }}</td>
            <td>${{ number_format($client->coverage_amount, 2, '.', ',') }}</td>
            <td>${{ number_format($client->excess_amount, 2, '.', ',') }}</td>
            <td>${{ number_format($client->premium_amount, 2, '.', ',') }}</td>
            <td>{{ $client->payment_period }}</td>

            <td>
                <a data-toggle="modal" data-target="#editClientModal{{ $client->id}}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
            </td>
            <td>
                <form action="{{ route('client.destroy', $client->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button>
                </form>
            </td>
            <td><a href="{{ route('client.report', $client->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-download"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addClientModal">Add New Client</button>
            </div>
        </div>
    </div>

    <!-- Edit Policy Modal -->
    @if(isset($client))
    <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel{{ $client->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editClientModalLabel{{ $client->id }}">Edit Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('client.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">

            <div class="form-group">
                        <label for="client_fname">Client Name</label>
                        <input type="text" name="client_fname" class="form-control" id="1client_fname" value=" {{ $client->client_fname }} " required>
            </div>

            <div class="form-group">
                        <label for="Age">Age</label> (Note, if age is under 25 then extra $250 is added to excess)
                        <input type="number" name="Age" class="form-control" id="1Age" value="{{ intval($client->Age) }}" required autocomplete="off">

            </div>

            <div class="form-group">
                        <label for="driving_license_number">Driving License #</label>
                        <input type="number" name="driving_license_number" class="form-control" id="1driving_license_number" value="{{ $client->driving_license_number }}" required>

            </div>

            <div class="form-group">
                            <label for="client_email">Email</label>
                            <input type="email" name="client_email" class="form-control" id="1client_email" value="{{ $client->client_email }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            <div class="invalid-feedback">Please enter a valid email address</div>
            </div>

            <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" id="1phone_number" value="{{ $client->phone_number }}" required>
            </div>

            <div>
            <label for="vehicle_model">Vehicle Make</label>
                        <select name="vehicle_model" class="form-control" id="1vehicle_model"  required>
                                <option value="{{ $client->vehicle_model }}">
                                    @switch($client->vehicle_model)
                                        @case(99)
                                            Toyota
                                            @break
                                        @case(90)
                                            Honda
                                            @break
                                        @case(85)
                                            Ford
                                            @break
                                        @case(80)
                                            Nissan
                                            @break
                                        @case(75)
                                            Chevrolet
                                            @break
                                        @case(72)
                                            Hyundai
                                            @break
                                        @case(70)
                                            Kia
                                            @break
                                        @default
                                            Unknown
                                    @endswitch
                                </option>

                                <option value=99>Toyota</option>
                                <option value=90>Honda</option>
                                <option value=85>Ford</option>
                                <option value=80>Nissan</option>
                                <option value=75>Chevrolet</option>
                                <option value=72>Hyundai</option>
                                <option value=70>Kia</option>
                            </select>
            </div>

            <div class="form-group">
                        <label for="vehicle_registration">Vehicle Registration</label>
                        <input type="text" name="vehicle_registration" class="form-control" id="1vehicle_registration" value="{{ $client->vehicle_registration }}" required>
            </div>

            <div class="form-group" id="1policy_id_field">
                <label for="policy_id">Policy Taken</label>
                <select class="form-control" id="1policy_id" name="policy_id" >
                    @if ($policies->isEmpty())
                        <option value="">Policy not found, Add policy type first!</option>
                    @else
                        <option value="{{ $client->policy_type }}">{{ $client->policy_type }}</option>
                        @foreach($policies as $policy)
                            <option value="{{ $policy->id }}" data-max-coverage="{{ $policy->max_coverage_amount }}">{{ $policy->policy_type }}</option>
                        @endforeach
                    @endif
                </select>
            </div>


            <label for="coverage_amount">Coverage Amount</label>
                        <div>
                        <input type="number" name="coverage_amount" class="form-control" id="1coverage_amount" value="{{ $client->coverage_amount }}" required>
                            <div class="btn-group mt-2">
                                <button type="button" id="1coverage_button_35" class="btn btn-primary">35%</button>
                                <button type="button" id="1coverage_button_65" class="btn btn-primary">65%</button>
                                <button type="button" id="1coverage_button_100" class="btn btn-primary">100%</button>
                            </div>
                        </div>
                    </div>

            <div class="form-group">
                        <label for="excess_amount">Excess Amount</label>
                        <input type="number" name="excess_amount" class="form-control" id="1excess_amount" value="{{ $client->excess_amount }}" required>

            </div>

            <div class="form-group">
                <label for="payment_period">Payment Period</label>
                <select name="payment_period" class="form-control" id="1payment_period" required>
                    <option value="{{ $client->payment_period }}">{{ $client->payment_period }}</option>
                    <option value="monthly">Monthly</option>
                    <option value="quarterly">Quarterly</option>
                    <option value="annually">Annually</option>
                </select>
            </div>


            <div class="form-group">
                        <label for="policy_start_date">Policy Start Date</label>
                        <input type="text" name="policy_start_date" class="form-control" id="1policy_start_date" placeholder="YYYY-MM-DD" required pattern="\d{4}-\d{2}-\d{2}" value="{{ $client->policy_start_date }}" title="Please enter a date in the format YYYY-MM-DD">
                        <div class="invalid-feedback">Please enter a valid date in the format YYYY-MM-DD</div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
    </div>
    </div>
    @endif


    <!-- Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClientModalLabel">Add Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" form id="signUpForm" class="p-12 shadow-md rounded-2xl bg-white mx-auto border-solid border-2 border-gray-100 mb-8"     action="{{ route('client.store') }}">
                        @csrf
                        <div class="form-header flex gap-3 mb-4 text-xs text-center">
                            <span class="stepIndicator flex-1 pb-8 relative">Personal Details</span>
                            <span class="stepIndicator flex-1 pb-8 relative">Policy Info</span>
                        </div>
                <div class="step">  
                        <div class="mb-6">
                        <input type="text" placeholder= "Full Name" required autocomplete="off" name="client_fname" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" oninput="this.className = 'w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200'"  id="client_fname" required>
                        </div>
                        <div class="mb-6">
                        <input type="number" placeholder="Age" required autocomplete="off" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" name="Age" class="form-control" id="Age" required>
                        </div>
                        <div class="mb-6">
                        <input type="number" placeholder= "Driving License Number" required autocomplete="off" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" name="driving_license_number" class="form-control" id="driving_license_number" required>
                        </div>
                        <div class="mb-6">
                            <input type="email" placeholder="Email" required autocomplete="off" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" name="client_email" class="form-control" id="client_email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            <div class="invalid-feedback">Please enter a valid email address</div>
                        </div>
                        <div class="mb-6">
                        <input type="number" placeholder="Phone Number" required autocomplete="off" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" name="phone_number" class="form-control" id="phone_number" required>
                        </div>
                </div>
                <div class= "step">

                        <div class="mb-6" id="policy_id_field">
                            <label for="policy_id">Policy Taken</label>
                            <select class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="policy_id" name="policy_id" required>
                                @if ($policies->isEmpty())
                                    <option value="">Policy not found, Add policy type first!</option>
                                @else
                                    <option value="">Select Policy Type</option>
                                    @foreach($policies as $policy)
                                        <option value="{{ $policy->id }}" data-max-coverage="{{ $policy->max_coverage_amount }}" data-coverage-rate="{{ $policy->coverage_rate }}">{{ $policy->policy_type }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-6">
                        <select class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"  name="vehicle_model" class="form-control" id="vehicle_model" required>
                                <option value="">Vehicle Make</option>
                                <option value=99>Toyota</option>
                                <option value=90>Honda</option>
                                <option value=85>Ford</option>
                                <option value=80>Nissan</option>
                                <option value=75>Chevrolet</option>
                                <option value=72>Hyundai</option>
                                <option value=70>Kia</option>
                            </select>
                        </div>
                        <div class="mb-6">
                        <input type="text" placeholder="Vehicle Registration" required autocomplete="off" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" name="vehicle_registration" class="form-control" id="vehicle_registration" required>
                        </div>

                        <div class="mb-6">
                        <div>
                            <input type="number" placeholder= "Coverage Amount" name="coverage_amount" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="coverage_amount" required>
                            <div class="btn-group mt-2">
                                <button type="button" id="coverage_button_35" class="btn btn-primary">35%</button>
                                <button type="button" id="coverage_button_65" class="btn btn-primary">65%</button>
                                <button type="button" id="coverage_button_100" class="btn btn-primary">100%</button>
                            </div>
                        </div>
                    </div>


                        <div class="mb-6">
                                    <input type="number" name="excess_amount" required autocomplete="off" placeholder = "Excess Amount" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="excess_amount" required>

                        </div>

                        <div class="mb-6">
                            <select name="payment_period" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="payment_period" required>
                                <option value="">Payment Period</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="annually">Annually</option>
                            </select>
                        </div>
                        <div class="mb-6">
                        <input type="text" name="policy_start_date" required autocomplete="off" placeholder="Policy Start Date (YYYY-MM-DD)" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="policy_start_date" placeholder="YYYY-MM-DD" required pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD">
                        <div class="invalid-feedback">Please enter a valid date in the format YYYY-MM-DD</div>
                        </div>
                </div>

                        <!-- start previous / next buttons -->
                        <div class="form-footer flex gap-3">
                            <button type="button" id="prevBtn" class="flex-1 focus:outline-none border border-gray-300 py-2 px-5 rounded-lg shadow-sm text-center text-gray-700 bg-white hover:bg-gray-100 text-lg" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" id="nextBtn" class="flex-1 border border-transparent focus:outline-none p-3 rounded-md text-center text-white bg-indigo-600 hover:bg-indigo-700 text-lg" onclick="nextPrev(1)">Next</button>
                        </div>
                        <!-- end previous / next buttons -->
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection