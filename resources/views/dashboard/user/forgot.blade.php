<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot password</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">    
    <link rel="stylesheet" href="\css\loginstyles.css">
<body>

    <div class="container">
        <div class="row">
            <div class="login" style="margin-top: -350px;">
                  <h1>Forgot password</h1><hr>
                  <form action="{{ route('user.forgot.password.link') }}" method="post" autocomplete="off">
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
                    <p style="color: white; font-weight: bold;">
                        Enter your email address and we will send you a link to reset your password.
                    </p>
                      <div class="form-group">
                          <label for="email"style="color: white; font-weight: bold;">Email</label>
                          <input type="text" class="form-control" name="email" placeholder="Enter email address" value="{{ old('email') }}">
                          <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                      </div>
                      <div class="form-group mt-2">
                          <button type="submit" class="btn btn-primary">Send Reset Password Link</button>
                      </div>
                      <br>
                      <a href="{{ route('user.login') }}">Login</a>
                  </form>
            </div>
        </div>
    </div>
    
</body>
</html>