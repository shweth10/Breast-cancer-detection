<!DOCTYPE html>
<html>
<head>
	<title>Client Details</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			background-color: #F8F8FF;
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
		<h1>Client Details</h1>
	</header>

	<form method="POST" action="{{ route('client.update', $client->id) }}" method="POST">
	    @csrf
	    @method('PUT')
	    <div class="form-group">
	        <label for="client_fname">Client Name</label>
	        <input type="text" name="client_fname" class="form-control" id="client_fname" value="{{ $client->client_fname }}" required>
	    </div>
	    <div class="form-group">
		<div class="form-group">
	        <label for="Age">Age</label>
	        <input type="text" name="Age" class="form-control" id="Age" value="{{ $client->Age }}" required>
	    </div>
	    <div class="form-group">
	        <label for="driving_license_number">Driving License #</label>
	        <input type="number" name="driving_license_number" class="form-control" id="driving_license_number" value="{{ $client->driving_license_number }}" required>
	    </div>
	    <div class="form-group">
	        <label for="client_email">Email</label>
	        <input type="text" name="client_email" class="form-control" id="client_email" value="{{ $client->client_email }}" required>
	    </div>
		<div class="form-group">
	        <label for="phone_number">Phone Number</label>
	        <input type="number" name="phone_number" class="form-control" id="phone_number" value="{{ $client->phone_number }}" required>
	    </div>
	    <div class="form-group">
	        <label for="vehicle_model">Vehicle Model</label>
	        <input type="text" name="vehicle_model" class="form-control" id="vehicle_model" value="{{ $client->vehicle_model }}" required>
	    </div>
        <div class="form-group">
	        <label for="vehicle_registration">Vehicle Registration</label>
	        <input type="text" name="vehicle_registration" class="form-control" id="vehicle_registration" value="{{ $client->vehicle_registration }}" required>
	    </div>
	    <button type="submit" class="btn btn-primary">Save</button>
	</form>

	<div style="text-align: center; margin-top: 20px;">
		<button onclick="window.history.back();" style="background-color: #555555; color: #FFFFFF; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">Close Form</button>
	</div>
</body>
</html>
