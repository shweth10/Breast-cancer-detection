<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Policy Report</title>
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
    <p>Date: <?php echo date('F j, Y'); ?></p>
    <header>
        <h1>Car Policy Hub</h1>
    </header>
    <h3 style="text-decoration: underline">Policy Information Report:</h3>
    <table id="policy-table">
        <tr>
            <th>Policy ID:</th>
            <td>{{ $policy->id }}</td>
        </tr>
        <tr>
            <th>Policy Type:</th>
            <td>{{ $policy->policy_type }}</td>
        </tr>
        <tr>
            <th>Coverage Amount:</th>
            <td>{{ $policy->coverage_amount }}</td>
        </tr>
        <tr>
            <th>Coverage Information:</th>
            <td>{{ $policy->coverage_information }}</td>
        </tr>
        <tr>
            <th>Premium Amount:</th>
            <td>{{ $policy->premium_amount }}</td>
        </tr>
        <tr>
            <th>Policy Duration:</th>
            <td>{{ $policy->policy_duration }}</td>
        </tr>
        <tr>
            <th>Payment Period:</th>
            <td>{{ $policy->payment_period }}</td>
        </tr>
        <tr>
            <th>Policy Details Created on:</th>
            <td>{{ $policy->created_at }}</td>
        </tr>
        <tr>
            <th>Policy Details Last Updated:</th>
            <td>{{ $policy->updated_at }}</td>
        </tr>
    </table>
    <footer style="position: absolute; bottom: 0; width: 100%; height: 45px; background-color: #f2f2f2;">
        <p style="text-align: center; line-height: 40px;">Car Policy Hub © 2023. All rights reserved.</p>
    </footer>
</body>
</html>