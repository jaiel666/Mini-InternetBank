<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<nav class="navbar">
    <div class="navbar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="navbar-links">
        <a href="{{ route('main_page') }}">Back to Main Page</a>
    </div>
</nav>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Login to Your Account</h1>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="post" novalidate>
                @csrf

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    @if($errors->has('email'))
                        <span class="error">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    @if($errors->has('password'))
                        <span class="error">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
