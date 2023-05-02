@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Dashboard | Normal User')
@section('content')

<div class="row">
    <div class="col-md-12 mt-3">
    </div>
    @php
    $policies = App\Models\Policy::where('insurer_id', auth()->user()->id)->get();    
    $clients= App\Models\Client::where('insurer_id', auth()->user()->id)->get();
    @endphp

    <h3>Policy Details</h3>
    <table class="table">
    <thead>
        <tr>
            <th>Policy ID</th>
            <th>Policy Type</th>
            <th>Coverage Information</th>
            <th>Maximum Coverage Amount</th>
            <th>Policy Duration (Years)</th>
            <th>Coverage Rate (%)</th>
            <th></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($policies as $policy)
        <tr>
            <td>{{ $policy->id }}</td>
            <td>{{ $policy->policy_type }}</td>
            <td>
                @if(strlen($policy->coverage_information) > 20)
                    {{ substr($policy->coverage_information, 0, 20) }}...
                    <a href="#" data-toggle="modal" data-target="#coverageInfoModal{{ $policy->id }}">Read more</a>
                    <div class="modal fade" id="coverageInfoModal{{ $policy->id }}" tabindex="-1" role="dialog" aria-labelledby="coverageInfoModal{{ $policy->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="coverageInfoModal{{ $policy->id }}Label">Coverage Information</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{ $policy->coverage_information }}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{ $policy->coverage_information }}
                @endif
            </td>
            <td>${{ number_format($policy->max_coverage_amount, 2, '.', ',') }}</td>
            <td>{{ $policy->policy_duration }}</td>
            <td>{{ $policy->coverage_rate }}%</td>
            <td>
                <a data-toggle="modal" data-target="#editPolicyModal{{ $policy->id }}" class="btn btn-primary"><i class="nav-icon fas fa-edit"></i></a>
            </td>
            <td>
                <form action="{{ route('policy.destroy', $policy->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button>
                </form>
            </td>
            <td><a href="{{ route('policy.report', $policy->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-download"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addPolicyModal">Add New Product</button>
            </div>
        </div>
    </div>

    <!-- Edit Policy Modal -->
    @if(isset($policy))
    <div class="modal fade" id="editPolicyModal{{ $policy->id }}" tabindex="-1" role="dialog" aria-labelledby="editPolicyModalLabel{{ $policy->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editPolicyModalLabel{{ $policy->id }}">Edit Policy</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('policy.update', $policy->id) }}" method="POST">

        
            @csrf
            @method('PUT')
            <div class="modal-body">
            <div class="form-group">
                        <label for="policy_type">Policy Type</label>
                        <input type="text" name="policy_type" class="form-control" id="policy_type" value=" {{ $policy->policy_type }} " required>
                        </div>
                        <div class="form-group">
                        <label for="coverage_information">Coverage Information</label>
                        <input type="text" name="coverage_information" class="form-control" id="coverage_information" value="{{ $policy->coverage_information }}" required>
                        </div>
                        <div class="form-group">
                        <label for="max_coverage_amount">Maximum Coverage Amount</label>
                        <input type="number" name="max_coverage_amount" class="form-control" id="max_coverage_amount" value="{{ $policy->max_coverage_amount }}" required>
                        </div>
                        <div class="form-group">
                        <label for="policy_duration">Policy Duration(Years)</label>
                        <input type="number" name="policy_duration" class="form-control" id="policy_duration" value="{{ $policy->policy_duration }}" required>
                        </div>
                        <div class="form-group">
                        <label for="policy_duration">Coverage Rate(%)</label>
                        <input type="number" name="coverage_rate" class="form-control" id="coverage_rate" value="{{ $policy->coverage_rate }}" required>
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

    <!-- Add Policy Modal -->
    <div class="modal fade" id="addPolicyModal" tabindex="-1" role="dialog" aria-labelledby="addPolicyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPolicyModalLabel">Add Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('policy.store') }}">
                        @csrf
                        <div class="mb-6">
                        <input type="text" placeholder= "Policy Type" required autocomplete="off" name="policy_type" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="policy_type" required>
                        </div>
                        <div class="mb-6">
                        <input type="text" placeholder = "Coverage Information" required autocomplete="off" name="coverage_information" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="coverage_information" required>
                        </div>
                        <div class="mb-6">
                        <input type="number" placeholder = "Maximum Coverage Amount $" required autocomplete="off" name="max_coverage_amount" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="max_coverage_amount" required>
                        </div>
                        <div class="mb-6">
                        <input type="number" placeholder = "Policy Duration (Years)" required autocomplete="off"  name="policy_duration" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200"id="policy_duration" required>
                        </div>
                        <div class="mb-6">
                        <input type="number" placeholder = "Coverage Rate %" required autocomplete="off" name="coverage_rate" class="w-full px-4 py-3 rounded-md text-gray-700 font-medium border-solid border-2 border-gray-200" id="coverage_rate" required>
                        </div>
                        <button type="submit" class="flex-1 border border-transparent focus:outline-none p-3 rounded-md text-center text-white bg-indigo-600 hover:bg-indigo-700 text-lg">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection