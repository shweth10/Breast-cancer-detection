<!DOCTYPE html>
<html>
<head>
	<title>Payments Report</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>
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
				<th>Client Name</th>
				<th>Client Email</th>
				<th>Payment Method</th>
				<th>Payment Amount</th>
				<th>Payment Period</th>
				<th>Policy Type</th>
				<th>Payment Date</th>
				<th>Next Payment Date</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($payments as $payment)
			<tr>
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
</body>
</html>
