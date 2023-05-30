<!DOCTYPE html>
<html>
<head>
    <title>Policy Expired Notification</title>
    <style>
        /* Email styles */
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $client->policy_type }}</h1>
        <p>Dear {{ $client->client_fname }},</p>
        
        <?php
            $currentDate = date('Y-m-d');
            $policyEndDate = $client->policy_end_date;

            if ($policyEndDate > $currentDate) {
                echo "<p>You failed to pay your premium on time or chosen to end your renewal at the end of the year, thus resulting in a cancellation.</p>";
            } else {
                echo "<p>Your Policy has elapsed its allocated period.</p>";
            }
        ?>
        
        <p>Policy Details:</p>
        <ul>
            <li>Policy Type: {{ $client->policy_type }}</li>
            <li>Expiration Date: {{ $client->policy_end_date }}</li>
            <li>Payment Due Date: {{ $client->premium_due_date }}</li>
            <li>Payment Amount: ${{ $client->premium_amount }}</li>
            <!-- Add any additional relevant information about the expired policy -->
        </ul>
        
        <p>Please contact an Insurance Agent to Renew your Policy or Register a new one.</p>
        
        <p>Thank you.</p>
    </div>
</body>
</html>
