<!DOCTYPE html>
<html>
<head>
    <title>New Claim Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 16px;
        }

        p {
            margin-bottom: 8px;
        }

        ul {
            padding-left: 20px;
            margin-bottom: 16px;
        }

        li {
            margin-bottom: 8px;
        }

        .note {
            color: #888888;
            font-size: 14px;
            margin-top: 24px;
        }

        .thank-you {
            margin-top: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Claim Submitted</h1>
        <p>A new claim has been submitted. Here are the details:</p>
        <ul>
            <li>Claim ID: {{ $claim->id }}</li>
            <li>Incident Date: {{ $claim->incident_date }}</li>
            <li>Incident Details: {{ $claim->incident_details }}</li>
            <li>Claim Amount: {{ $claim->claim_amount }}</li>
            <li>Policy Type: {{ $claim->policy_type }}</li>
        </ul>
        <p class="note">Please review and take necessary action.</p>
        <p class="thank-you">Thank you.</p>
    </div>
</body>
</html>
