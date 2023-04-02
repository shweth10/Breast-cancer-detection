<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset password</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">    
    <link rel="stylesheet" href="\css\loginstyles.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="login" style="margin-top: -250px;">
                  <h1>Reset password</h1><hr>
                  <form action="{{ route('user.reset.password') }}" method="post" autocomplete="off">
                    @if (Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif

                    @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                      <div class="form-group">
                          <label for="email"style="color: white; font-weight: bold;">Email</label>
                          <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ $email ?? old('email') }}">
                          <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                      </div>
                      <div class="form-group">
                          <label for="password"style="color: white; font-weight: bold;">Password</label>
                          <input type="password" class="form-control" name="password" placeholder="Enter password" value="{{ old('password') }}">
                          <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                      </div>
                      <div class="form-group">
                        <label for="password"style="color: white; font-weight: bold;">Confirm password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter password" value="{{ old('password_confirmation') }}">
                        <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                    </div>
          
                      <div class="form-group">
                          <button type="submit" class="btn btn-primary">Reset password</button>
                      </div>
                      <br>
                      <a href="{{ route('user.login') }}">Login</a>
                  </form>
            </div>
        </div>
    </div>
    
</body>
</html>