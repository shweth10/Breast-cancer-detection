@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Dashboard | Normal User')
@section('content')

<div class="row">
    <div class="col-md-12 mt-3">
        <h4>Insurance Company Dashboard</h4>
    </div>
    @php
    $policies = App\Models\Policy::all();
    @endphp
    <table class="table">
    <thead>
        <tr>
            <th>Policy Type</th>
            <th>Coverage Amount</th>
            <th>Premium Amount</th>
            <th>Policy Duration (Years)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($policies as $policy)
        <tr>
            <td>{{ $policy->policy_type }}</td>
            <td>{{ $policy->coverage_amount }}</td>
            <td>{{ $policy->premium_amount }}</td>
            <td>{{ $policy->policy_duration }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection