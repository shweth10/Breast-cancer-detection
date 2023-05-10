@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Dashboard | Normal User')
@section('content')

<div class="row">
    <div class="col-md-12 mt-3">
    </div>
    @php
    $clients = App\Models\Client::where('client_email', auth()->user()->email)->get();
    $policies=App\Models\Policy::all();
    $payments=App\Models\Payment::all();
    @endphp
    
    <h3>Premium Details</h3>
    <table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Policy Type</th>
            <th>Payment Amount</th>
            <th>Period</th>
            <th>Last Payment Made</th>
            <th>Next Payment Due</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->client_fname }}</td>
                <td>{{ $client->policy_type }}</td>
                <td>${{ number_format($client->premium_amount, 2, '.', ',') }}</td>
                <td>{{ $client->payment_period }}</td>
                <td>{{ $client->payment_date }}</td>
                <td>{{ $client->premium_due_date }}</td>
                <td>
                    @php
                        $status = '';
                        $class = '';

                        $current_date = date('Y-m-d');
                        $due_date = date('Y-m-d', strtotime($client->premium_due_date . ' - 20 days'));

                        if ($current_date > $client->premium_due_date) {
                            $status = 'Expired';
                            $class = 'm-2 inline-block rounded bg-danger py-1 px-2 text-sm font-semibold text-white';
                        } elseif ($current_date >= $due_date && $current_date <= $client->premium_due_date) {
                            $status = 'Due';
                            $class = 'm-2 inline-block rounded bg-warning py-1 px-2 text-sm font-semibold text-black';
                        } else {
                            $status = 'Active';
                            $class = 'm-2 inline-block rounded bg-success py-1 px-2 text-sm font-semibold text-white';
                        }
                    @endphp
                    <span class="{{ $class }}">{{ $status }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

<div class="text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addFundsModal">Make Payment</button>

            </div>
        </div>
    </div>
    <div class="modal fade" id="addFundsModal" tabindex="-1" role="dialog" aria-labelledby="addFundsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('payment.store') }}" method="POST">
                <div class=" rounded-md shadow-md overflow-hidden">
    <div class="px-6 py-4 bg-gray-900 text-white">
        <h1 class="text-lg font-bold">Debit/Credit Card</h1>
    </div>
    <div class="px-6 py-4">

    @csrf
                        <div class="form-group">
                            <label for="client_fname">Select Client</label>
                            <select class="form-control" id="id" name="id" required>
                                @if ($policies->isEmpty())
                                <option value="">Policy not found, Add policy type first!</option>
                                @else
                                <option value="">Client List</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_fname }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="payment_date">Payment Date</label>
                        <input type="text" name="payment_date" class="form-control" id="payment_date" placeholder="YYYY-MM-DD" required pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD">
                        <div class="invalid-feedback">Please enter a valid date in the format YYYY-MM-DD</div>
                        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="card_number">
                Card Number
            </label>
            <input
                class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="card_number" type="text" name="card_number"placeholder="**** **** **** ****">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="card_fname">
                Card Holder Full Name
            </label>
            <input
                class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="card_fname" type="text" name="card_fname" placeholder="Full Name">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="exp_date">
                Expiration Date
            </label>
            <input
                class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="exp_date" type="text" name="exp_date"placeholder="MM/YY">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="cvv">
                CVV
            </label>
            <input
                class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="cvv" type="text" name="cvv"placeholder="***">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
                    </form>
            </div>
        </div>
    </div>
@endsection