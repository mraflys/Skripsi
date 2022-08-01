<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/styleEmil.css">
    <title>Login</title>
</head>
<body>
    <div class="login-regis">
        <div class="logo-login-regis">
            <h1>JKI</h1>
        </div>
        <div class="form-login-regis">
            <h1>Login</h1>
            @if (!is_null(session('message_error')))
                <p class="message-status-login" style="color: red">{{ session('message_error') }}</p>
            @endif
            @if (session('message_success'))
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <h6>{{ session('message_success') }}</h6>

                </div>
            @endif
            @if (session('logout_msg'))
                <p class="message-status-login">Logout Berhasil</p>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <p class="message-status-login" style="color: red">{{ $error }}</p> <br>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
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
                        <span class="invalid-feedback" style="color: red" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="submit-next-button">Submit</button>
            </form>
            <div class="information">
                <p>Apakah anda baru? tidak memiliki akun?</p>
                <a href="{{ route('register') }}">Daftar disini</a>
            </div>
        </div>
    </div>
</body>
</html>