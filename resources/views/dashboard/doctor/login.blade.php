<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor Login</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
    <link rel="stylesheet" href="\css\loginstyles.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="login" style="margin-top: -350px;>
                 <h4>Doctor Login</h4><hr>
                 <form action="{{ route('doctor.check') }}" method="post">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif

                    @if (Session::get('info'))
                        <div class="alert alert-info">
                            {{ Session::get('info') }}
                        </div>
                    @endif

                    @csrf
                     <div class="form-group">
                         <label for="email" style="color: white; font-weight: bold;">Email</label>
                         <input type="text" class="form-control" name="email" placeholder="Enter email address" 
                         value="{{ Session::get('verifiedEmail') ? Session::get('verifiedEmail') : old('email') }}">
                         <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                     </div>
                     <div class="form-group">
                         <label for="password"style="color: white; font-weight: bold;">Password</label>
                         <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                         <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                     </div>
                     <a href="{{ route('doctor.forgot.password.form') }}">Forgot Password</a>
                     <div class="form-group mt-2">
                         <button type="submit" class="btn btn-primary">Login</button>
                     </div>
                     <br>
                     <a href="{{ route('doctor.register') }}">Create new Account</a>
                 </form>
            </div>
        </div>
    </div>
</body>
</html>