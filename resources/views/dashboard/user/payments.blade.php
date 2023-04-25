@extends('layouts.main-template')
@section('title', isset($title) ? $title : 'Dashboard | Normal User')
@section('content')

<div class="row">
    <div class="col-md-12 mt-3">
    </div>
    @php
    $clients= App\Models\Client::where('insurer_id', auth()->user()->id)->get();
    $policies=App\Models\Policy::where('insurer_id', auth()->user()->id)->get();
    $payments=App\Models\Payment::where('insurer_id', auth()->user()->id)->get();
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
                <td>
                    <form action="{{ route('client.destroy', $client->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="nav-icon fas fa-trash"></i></button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('premium.report', $client->id) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-download"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>

<div class="text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addPaymentModal">Mark New Payment</button>
                <a href="{{ route('payments.report') }}" class="btn btn-success btn-sm">Generate Payments Report</a>

            </div>
        </div>
    </div>

    <!-- Add Client Modal -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel">Mark New Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('payment.store') }}" method="POST">

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
                        <label for="payment_method">Payment Method</label>
                        <select class="form-control" id="payment_method" name="payment_method" required>
                                <option value="">Options</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                
                            </select>

                        <div class="form-group">
                        <label for="payment_date">Payment Date</label>
                        <input type="text" name="payment_date" class="form-control" id="payment_date" placeholder="YYYY-MM-DD" required pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format YYYY-MM-DD">
                        <div class="invalid-feedback">Please enter a valid date in the format YYYY-MM-DD</div>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection