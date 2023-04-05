<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Client Report</title>
</head>
<body>
    <header>
        <p>Company Email: {{ auth()->user()->email }}</p>
        <p>Date: <?php echo date('F j, Y'); ?></p>
        <h1 style="text-align: center; text-decoration: underline;">Car Policy Hub</h1>
        <h2 style="text-align: center; text-decoration: underline;">Insurer: {{ auth()->user()->name }}</h2>
        <h3 style="text-align: center;">Client Report</h3>
    </header>
    <table id="client-table" style="margin: 0 auto; border-collapse: collapse; width: 100%; max-width: 600px; font-family: Arial, sans-serif; border: 1px solid #ccc;">
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
            <th>Policy Duration: </th>
            <td>{{ $client->policy_duration }} Years</td>
        </tr>
        <tr>
            <th>Coverage Amount: </th>
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
            <th>Age:</th>
            <td>{{ $client->Age }}</td>
        </tr>
        <tr>
            <th>Driving License Number:</th>
            <td>{{ $client->driving_license_number }}</td>
        </tr>
        <tr>
            <th>Client Email:</th>
            <td>{{ $client->client_email }}</td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td>{{ $client->phone_number }}</td>
        </tr>
        <tr>
            <th>Vehicle Model:</th>
            <td>{{ $client->vehicle_model }}</td>
        </tr>
        <tr>
            <th>Vehicle Registration:</th>
            <td>{{ $client->vehicle_registration }}</td>
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
    <footer style="position: absolute; bottom: 0; width: 100%; height: 60px; background-color: #f2f2f2;">
        <p style="text-align: center; line-height: 40px;">Car Policy Hub © 2023. All rights reserved.</p>
    </footer>
</body>
</html>