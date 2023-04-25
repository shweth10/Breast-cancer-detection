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
            <td>{{ $client->vehicle_model }}</td>
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
        <form action="{{ route('clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
            <div class="form-group">
            <label for="client_fname">Client Name</label>
                        <input type="text" name="client_fname" class="form-control" id="client_fname" value=" {{$client->client_fname }} "required>
                        </div>
                        <div class="form-group">
                            <label for="Age">Age</label> (Note, if age is under 25 then extra $250 is added to excess)
                            <input type="number" name="Age" class="form-control" id="Age" value="{{$client->Age}}" required>
                        </div>

                        <div class="form-group">
                        <label for="driving_license_number">Driving License #</label>
                        <input type="number" name="driving_license_number" class="form-control" id="driving_license_number" value="{{$client->driving_license_number}}"required>
                        </div>
                        <div class="form-group">
                            <label for="client_email">Email</label>
                            <input type="email" name="client_email" class="form-control" id="client_email" value="{{$client->client_email}}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            <div class="invalid-feedback">Please enter a valid email address</div>
                        </div>
                        <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" value="{{$client->phone_number}}" required>
                        </div>
                        <div class="form-group">
                        <label for="vehicle_model">Vehicle Make</label>
                        <select name="vehicle_model" class="form-control" id="vehicle_model" required>
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
                        <input type="text" name="vehicle_registration" class="form-control" id="vehicle_registration" value="{{$client->vehicle_registration}}"required>
                        </div>

                        <div class="form-group" id="policy_id_field">
                            <label for="policy_id">Policy Taken</label>
                            <select class="form-control" id="policy_id" name="policy_id" required>
                                @if ($policies->isEmpty())
                                <option value="">Policy not found, Add policy type first!</option>
                                @else
                                <option value="{{$client->policy_id}}">{{$client->policy_type}}</option>
                                @foreach($policies as $policy)
                                    <option value="{{ $policy->id }}" data-max-coverage="{{ $policy->max_coverage_amount }}">{{ $policy->policy_type }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="coverage_amount">Coverage Amount ($)</label>
                            <div class="slider-container">
                            @if ($policies->isEmpty())
                                <option value="">Policy not found, Add policy type first!</option>
                                @else
                                <span class="slider-value-current" value="{{ max(0.25 * $policy->max_coverage_amount, 0) }}" id="sliderValue">${{ number_format(0.25 * $policy->max_coverage_amount, 2, '.', ',') }}</span>
                                <input type="range" name="coverage_amount"  value="{{$client->coverage_amount}}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" id="coverage_amount" required min="{{ max(0.25 * $policy->max_coverage_amount, 0) }}" max="{{ $policy->max_coverage_amount }}" step="1" onchange="updateSliderValue(this.value)">
                                <div class="slider-value-container">
                                    <span class="slider-value-min">Min- ${{ number_format(0.25 * $policy->max_coverage_amount, 2, '.', ',') }}</span>
                                    <span class="slider-value-max">Max- ${{ number_format($policy->max_coverage_amount, 2, '.', ',') }} </span>
                                    @endif
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <label for="payment_period">Payment Period</label>
                            <select name="payment_period" class="form-control" id="payment_period" required>
                                <option value="{{$client->payment_period}}">{{$client->payment_period}}</option>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="annually">Annually</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="policy_start_date">Policy Start Date</label>
                        <input type="text" value= "{{$client->policy_start_date}}" name="policy_start_date" class="form-control" id="policy_start_date" placeholder="YYYY-MM-DD" required pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD">
                        <div class="invalid-feedback">Please enter a valid date in the format YYYY-MM-DD</div>
                        </div>

                        
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
                    <form method="POST" action="{{ route('client.store') }}">
                        @csrf
                        <div class="form-group">
                        <label for="client_fname">Client Name</label>
                        <input type="text" name="client_fname" class="form-control" id="client_fname" required>
                        </div>
                        <div class="form-group">
                        <label for="Age">Age</label> (Note, if age is under 25 then extra $250 is added to excess)
                        <input type="number" name="Age" class="form-control" id="Age" required>
                        </div>
                        <div class="form-group">
                        <label for="driving_license_number">Driving License #</label>
                        <input type="number" name="driving_license_number" class="form-control" id="driving_license_number" required>
                        </div>
                        <div class="form-group">
                            <label for="client_email">Email</label>
                            <input type="email" name="client_email" class="form-control" id="client_email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            <div class="invalid-feedback">Please enter a valid email address</div>
                        </div>
                        <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" required>
                        </div>
                        <div class="form-group">
                        <label for="vehicle_model">Vehicle Make</label>
                        <select name="vehicle_model" class="form-control" id="vehicle_model" required>
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
                        <input type="text" name="vehicle_registration" class="form-control" id="vehicle_registration" required>
                        </div>

                        <div class="form-group" id="policy_id_field">
                            <label for="policy_id">Policy Taken</label>
                            <select class="form-control" id="policy_id" name="policy_id" required>
                                @if ($policies->isEmpty())
                                <option value="">Policy not found, Add policy type first!</option>
                                @else
                                <option value="">Select Policy Type</option>
                                @foreach($policies as $policy)
                                    <option value="{{ $policy->id }}" data-max-coverage="{{ $policy->max_coverage_amount }}">{{ $policy->policy_type }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="coverage_amount">Coverage Amount ($)</label>
                            <div class="slider-container">
                            @if ($policies->isEmpty())
                                <option value="">Policy not found, Add policy type first!</option>
                                @else
                                <span class="slider-value-current" value="{{ max(0.25 * $policy->max_coverage_amount, 0) }}" id="sliderValue">${{ number_format(0.25 * $policy->max_coverage_amount, 2, '.', ',') }}</span>
                                <input type="range" name="coverage_amount" value="{{ max(0.25 * $policy->max_coverage_amount, 0) }}" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" id="coverage_amount" required min="{{ max(0.25 * $policy->max_coverage_amount, 0) }}" max="{{ $policy->max_coverage_amount }}" step="1" onchange="updateSliderValue(this.value)">
                                <div class="slider-value-container">
                                    <span class="slider-value-min">Min- ${{ number_format(0.25 * $policy->max_coverage_amount, 2, '.', ',') }}</span>
                                    <span class="slider-value-max">Max- ${{ number_format($policy->max_coverage_amount, 2, '.', ',') }} </span>
                                    @endif
                                </div>
                            </div>  
                        </div>
                        <div class="form-group">
                            <label for="excess_amount">Excess Amount($)</label>
                            <div class="">
                                <button class="btn btn-success btn-sm" type="button" onclick="setExcessAmount(0.05)">5% </button>
                                <button class="btn btn-danger btn-sm" type="button" onclick="setExcessAmount(0.10)">10% </button>
                            </div>
                            <input type="number" name="excess_amount" class="form-control" id="excess_amount" required readonly>

                        </div>

                        <div class="form-group">
                            <label for="payment_period">Payment Period</label>
                            <select name="payment_period" class="form-control" id="payment_period" required>
                                <option value="monthly">Monthly</option>
                                <option value="quarterly">Quarterly</option>
                                <option value="annually">Annually</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="policy_start_date">Policy Start Date</label>
                        <input type="text" name="policy_start_date" class="form-control" id="policy_start_date" placeholder="YYYY-MM-DD" required pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD">
                        <div class="invalid-feedback">Please enter a valid date in the format YYYY-MM-DD</div>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection