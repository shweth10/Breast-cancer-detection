<!DOCTYPE html>
<html>
<head>
	<title>Payments Report</title>
	<style>
		body {
            font-family: Arial, sans-serif;
        }
        header {
            text-align: center;
        }
        header h1, header h2 {
            text-decoration: underline;
        }
        table {
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #eee;
        }
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            background-color: #f2f2f2;
            text-align: center;
            line-height: 40px;
        }
	</style>
</head>
<body>
    @php
    $clients= App\Models\Client::all();
    $policies=App\Models\Policy::all();
    $payments=App\Models\Payment::all();
    @endphp
    
	<p>Company Email: {{ auth()->user()->email }}</p>
    <p>Date: <?php echo date('F j, Y'); ?></p>
    <header>
        <h1>Car Policy Hub</h1>
        <h2>Insurer: {{ auth()->user()->name }}</h2>
    </header>
	<h2>Payments Report</h2>
	<table>
		<thead>
			<tr>
				<th>Payment ID</th>
				<th>Client Name</th>
				<th>Client Email</th>
				<th>Payment Method</th>
				<th>Payment Amount</th>
				<th>Payment Period</th>
				<th>Policy Type</th>
				<th>Payment Date</th>
				<th>Next Payment Due</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($payments as $payment)
			<tr>
				<td>{{ $payment->id }}</td>
				<td>{{ $payment->client_fname }}</td>
				<td>{{ $payment->client_email }}</td>
				<td>{{ $payment->payment_method }}</td>
				<td>{{ $payment->premium_amount }}</td>
				<td>{{ $payment->payment_period }}</td>
				<td>{{ $payment->policy_type }}</td>
				<td>{{ $payment->payment_date }}</td>
				<td>{{ $payment->next_payment_date }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<footer style="position: absolute; bottom: 0; width: 100%; height: 45px; background-color: #f2f2f2;">
        <p style="text-align: center; line-height: 40px;">Car Policy Hub © 2023. All rights reserved.</p>
    </footer>
</body>
</html>
