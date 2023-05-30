<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancellation Request</title>
</head>
<body>
<p>Hello,</p>

<p>You have received a renewal cancellation request from a client. The customer wishes to discontinue payments by the end of this year. Here are the client details:</p>

<ul>
    <li><strong>Client Name:</strong> {{ $client->client_fname }}</li>
    <li><strong>Client Email:</strong> {{ $client->client_email }}</li>
    <li><strong>Policy :</strong> {{ $client->policy_type }}</li>
    <li><strong>Policy Expiration Date :</strong> {{ $client->policy_end_date }}</li>
    <!-- Include any other relevant client information -->
</ul>

<p>Please take appropriate action based on this request.</p>

<p>Thank you.</p>
</body>
</html>
