@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Policy | Client')
@section('content')

<div class="relative max-w-7xl mx-auto">
    <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden lg:max-w-none lg:flex">
        <div class="flex-1 px-6 py-8 lg:p-12 bg-gray-600">
            <h3 class="text-2xl font-extrabold text-white sm:text-3xl">Premium Details</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mt-3">
    </div>
    @php
    $clients = App\Models\Client::where('client_email', auth()->user()->email)->get();
    $policies=App\Models\Policy::all();
    $payments=App\Models\Payment::all();
    @endphp
    

@foreach($clients as $client)
@php
    $policyType = $client->policy_type;
    $coverageInformation = $policies->where('policy_type', $policyType)->pluck('coverage_information')->first();
@endphp
<div class="p-10">
    <div class="relative max-w-7xl mx-auto">
        <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden lg:max-w-none lg:flex">
            <div class="flex-1 px-6 py-8 lg:p-12 bg-gray-600">
                <h3 class="text-2xl font-extrabold text-white sm:text-3xl">{{ $client->policy_type }}</h3>
                </p>
                <div class="mt-8">
                    <div class="flex items-center">
                        <div class="flex-1 border-t-2 border-gray-200"></div>
                    </div>
                    <ul role="list" class="mt-8 space-y-5 lg:space-y-0 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:gap-y-5">
                        <li class="flex items-start lg:col-span-1">
                            <div class="flex-shrink-0"><svg class="h-5 w-5 text-green-400"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg></div>
                                <div class="ml-3">
                <p class="text-white">{{ $coverageInformation }}</p>
                <p class="text-white">Last Payment Made: {{ $client->payment_date }}</p>
                <p class="text-white">Next Payment Due: {{ $client->premium_due_date }}</p>
                <p class="text-white">Policy End Date: {{ $client->policy_end_date }}</p>
              </div>
                        </li>
                </div>
            </div>
            <div class="py-8 px-6 text-center lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12 bg-gray-700">
    @php
        $status = '';
        $class = '';
        $buttonText = '';
        $buttonClass = '';

        $current_date = date('Y-m-d');
        $due_date = date('Y-m-d', strtotime($client->premium_due_date . ' - 20 days'));
        $end_date = $client->policy_end_date;

        if ($current_date > $end_date) {
            $status = 'Expired';
            $class = 'm-2 inline-block rounded bg-danger py-1 px-2 text-sm font-semibold text-white';
            $buttonText = 'Expired';
            $buttonClass = 'opacity-50 cursor-not-allowed';
        } elseif ($current_date > $client->premium_due_date && $current_date <= $end_date) {
            $status = 'Expired';
            $class = 'm-2 inline-block rounded bg-danger py-1 px-2 text-sm font-semibold text-white';
            $buttonText = 'Expired';
            $buttonClass = 'opacity-50 cursor-not-allowed';
        } elseif ($current_date >= $due_date && $current_date <= $client->premium_due_date) {
            $status = 'Due';
            $class = 'm-2 inline-block rounded bg-warning py-1 px-2 text-sm font-semibold text-black';
            $buttonText = 'Pay Now';
            $buttonClass = '';
        } else {
            $status = 'Active';
            $class = 'm-2 inline-block rounded bg-success py-1 px-2 text-sm font-semibold text-white';
            $buttonText = 'Paid';
            $buttonClass = 'opacity-50 cursor-not-allowed';
        }

    @endphp

    <span class="{{ $class }}">{{ $status }}</span>

    <div class="mt-4 flex items-center justify-center text-5xl font-extrabold text-white">
        <span>${{ $client->premium_amount }}</span><span class="ml-3 text-xl font-medium text-gray-50">FJD</span>
    </div>

    <div class="mt-6">
        <div class="rounded-md shadow">
        <a @if ($status === 'Due') data-toggle="modal" data-target="#addFundsModal" @endif
        class="flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 {{ $buttonClass }}">
        {{ $buttonText }}
        </a>

        </div>
        <div>
        @if ($client->client_email === auth()->user()->email && $status !== 'Expired')
    <form action="{{ route('cancel-renewal') }}" method="POST">
        @csrf
        <input type="hidden" name="client_id" value="{{ $client->id }}">
        <button type="submit" class="btn btn-danger">Request Renewal Cancellation</button>
    </form>
@elseif ($status === 'Expired')
    <p class="text-white">Renewal cancellation is not available for expired policies.</p>
@endif


</div>

    </div>

                    <p class="text-gray-300 text-sm mt-3">{{ $client->payment_period }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

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
            @foreach($clients as $client)
                @if ($client->client_email === auth()->user()->email)
                    <option value="{{ $client->id }}" selected>{{ $client->client_fname }} - {{ $client->policy_type }}</option>
                @else
                    <option value="{{ $client->id }}">{{ $client->client_fname }} - {{ $client->policy_type }}</option>
                @endif
            @endforeach
        @endif
    </select>
</div>

                        <div class="form-group">
                        <label for="payment_date">Current Date</label>
                        <input type="text" name="payment_date" class="form-control" id="payment_date" placeholder="YYYY-MM-DD" required pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD">
                        <div class="invalid-feedback">Please enter a valid date in the format YYYY-MM-DD</div>
                        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="card_number">
                Card Number
            </label>
            <input
                class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="card_number" type="number" name="card_number"placeholder="**** **** **** ****">
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
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="account_wallet">
                Amount$
            </label>
            <input
                class="appearance-none border border-gray-400 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="account_wallet" type="number" name="account_wallet"placeholder="Enter amount $">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
                    </form>
            </div>
        </div>
    </div>
@endsection