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
    <table class="table">
    <thead>
        <tr>
            <th>Client Name</th>
            <th>Age</th>
            <th>Driving License #</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Vehicle Model</th>
            <th>Vehicle Registration</th>
            <th>Policy Taken</th>

        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->client_fname }}</td>
            <td>{{ $client->Age }}</td>
            <td>{{ $client->driving_license_number }}</td>
            <td>{{ $client->client_email }}</td>
            <td>{{ $client->phone_number }}</td>
            <td>{{ $client->vehicle_model }}</td>
            <td>{{ $client->vehicle_registration }}</td>
            <td>{{ $client->policy_type }}</td>
            <td>
                <a href="{{ route('client.edit', $client->id) }}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('client.destroy', $client->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            <td><a href="{{ route('client.report', $client->id) }}" class="btn btn-success btn-sm">Report</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addClientModal">Add New Client</button>
            </div>
        </div>
    </div>

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
                        <label for="Age">Age</label>
                        <input type="number" name="Age" class="form-control" id="Age" required>
                        </div>
                        <div class="form-group">
                        <label for="driving_license_number">Driving License #</label>
                        <input type="number" name="driving_license_number" class="form-control" id="driving_license_number" required>
                        </div>
                        <div class="form-group">
                        <label for="client_email">Email</label>
                        <input type="text" name="client_email" class="form-control" id="client_email" required>
                        </div>
                        <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" name="phone_number" class="form-control" id="phone_number" required>
                        </div>
                        <div class="form-group">
                        <label for="vehicle_model">Vehicle Model</label>
                        <input type="text" name="vehicle_model" class="form-control" id="vehicle_model" required>
                        </div>
                        <div class="form-group">
                        <label for="vehicle_registration">Vehicle Registration</label>
                        <input type="text" name="vehicle_registration" class="form-control" id="vehicle_registration" required>
                        </div>

                        <div class="form-group" id="policy_id_field">
                            <label for="policy_id">Policy Taken</label>
                            <select class="form-control" id="policy_id" name="policy_id" required>
                                @if ($policies->isEmpty())
                                <option value="">Policy not found, first add a policy type!</option>
                                @else
                                <option value="">Select Policy Type</option>
                                @foreach($policies as $policy)
                                    <option value="{{ $policy->id }}">{{ $policy->policy_type }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection