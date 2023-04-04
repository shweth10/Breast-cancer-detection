<!DOCTYPE html>
<html>
<head>
	<title>Policy Details</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			background-color: #333333;
			color: #FFFFFF;
			font-family: Arial, sans-serif;
		}

		h1 {
			margin-top: 20px;
			margin-bottom: 30px;
			text-align: center;
		}

		form {
			max-width: 500px;
			margin: 0 auto;
			padding: 30px;
			background-color: #444444;
			border-radius: 10px;
		}

		.form-group {
			margin-bottom: 15px;
		}

		label {
			display: block;
			margin-bottom: 5px;
		}

		input[type="text"],
		input[type="number"] {
			width: 100%;
			padding: 10px;
			background-color: #555555;
			color: #FFFFFF;
			border: none;
			border-radius: 5px;
		}

		button {
			display: block;
			margin: 0 auto;
			padding: 10px;
			background-color: #CCCCCC;
			color: #333333;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		button:hover {
			background-color: #DDDDDD;
		}
	</style>
</head>
<body>
	<header>
		<h1>Policy Details</h1>
	</header>

	<form method="POST" action="{{ route('policy.update', $policy->id) }}" method="POST">
	    @csrf
	    @method('PUT')
	    <div class="form-group">
	        <label for="policy_type">Policy Type</label>
	        <input type="text" name="policy_type" class="form-control" id="policy_type" value="{{ $policy->policy_type }}" required>
	    </div>
	    <div class="form-group">
		<div class="form-group">
	        <label for="coverage_information">Coverage Information</label>
	        <input type="text" name="coverage_information" class="form-control" id="coverage_information" value="{{ $policy->coverage_information }}" required>
	    </div>
	    <div class="form-group">
	        <label for="coverage_amount">Coverage Amount($)</label>
	        <input type="number" name="coverage_amount" class="form-control" id="coverage_amount" value="{{ $policy->coverage_amount }}" required>
	    </div>
	    <div class="form-group">
	        <label for="premium_amount">Premium Amount($)</label>
	        <input type="number" name="premium_amount" class="form-control" id="premium_amount" value="{{ $policy->premium_amount }}" required>
	    </div>
		<div class="form-group">
	        <label for="payment_period">Payment Period</label>
	        <select name="payment_period" class="form-control" id="payment_period" value="{{ $policy->payment_period }}" required>
				<option value="monthly">Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="annually">Annually</option>
            </select>
	    </div>
	    <div class="form-group">
	        <label for="policy_duration">Policy Duration(Years)</label>
	        <input type="number" name="policy_duration" class="form-control" id="policy_duration" value="{{ $policy->policy_duration }}" required>
	    </div>
	    <button type="submit" class="btn btn-primary">Save</button>
	</form>

	<div style="text-align: center; margin-top: 20px;">
		<button onclick="window.history.back();" style="background-color: #555555; color: #FFFFFF; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">Go Back</button>
	</div>
</body>
</html>
