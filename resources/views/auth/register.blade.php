<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/styleEmil.css">
    <title>Register</title>
</head>
<body>
    <div class="login-regis">
        <div class="logo-login-regis">
            <h1>JKI</h1>
        </div>
        <div class="form-login-regis">
            <h1>Register</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="group-form">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Type Correctly" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" style="color: red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="group-form">
                    <label for="email">E-Mail Address</label>
                    <input type="text" name="email" id="email" placeholder="Type Correctly" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" style="color: red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="group-form">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Type Correctly" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                        <span class="invalid-feedback" style="color: red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="group-form">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Type Correctly" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="group-form">
                    <label for="password-confirm">Password</label>
                    <input type="password" name="password_confirmation" id="password-confirm" placeholder="Type Correctly" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="submit-next-button">Next</button>
            </form>
            <div class="step">
                <h2>Step</h2>
                <a href="#" class="steps active">1</a>
                <a href="#" class="steps">2</a>
            </div>
        </div>
    </div>
</body>
</html>
