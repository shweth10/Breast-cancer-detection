<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Premium Report</title>
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
    <p>Company Email: {{ auth()->user()->email }}</p>
    <p>Date: <?php echo date('F j, Y'); ?></p>
    <header>
        <h1>Car Policy Hub</h1>
        <h2>Insurer: {{ auth()->user()->name }}</h2>
    </header>
    <h3 style="text-decoration: underline">Premium Report:</h3>
    <table id="client-table">
        <tr>
            <th>Client ID:</th>
            <td>{{ $client->id }}</td>
        </tr>
        <tr>
            <th>Client Name:</th>
            <td>{{ $client->client_fname }}</td>
        </tr>
        <tr>
            <th>Policy ID:</th>
            <td>{{ $client->policy_id }}</td>
        </tr>
        <tr>
            <th>Policy Type:</th>
            <td>{{ $client->policy_type }}</td>
        </tr>
        <tr>
            <th>Policy Start Date:</th>
            <td>{{ $client->policy_start_date }}</td>
        </tr>
        <tr>
            <th>Premium Due Date:</th>
            <td>{{ $client->premium_due_date }}</td>
        </tr>
        <tr>
            <th>Policy Duration:</th>
            <td>{{ $client->policy_duration }} Years</td>
        </tr>
        <tr>
            <th>Coverage Amount:</th>
            <td>${{ $client->coverage_amount }}</td>
        </tr>
        <tr>
            <th>Premium To Be Paid:</th>
            <td>${{ $client->premium_amount }}</td>
        </tr>
        <tr>
            <th>Payment Period:</th>
            <td>{{ $client->payment_period }}</td>
        </tr>
        <tr>
            <th>Client Details Created on:</th>
            <td>{{ $client->created_at }}</td>
        </tr>
        <tr>
            <th>Client Details Last Updated:</th>
            <td>{{ $client->updated_at }}</td>
        </tr>
    </table>
    <footer style="position: absolute; bottom: 0; width: 100%; height: 45px; background-color: #f2f2f2;">
        <p style="text-align: center; line-height: 40px;">Car Policy Hub © 2023. All rights reserved.</p>
    </footer>
</body>
</html>