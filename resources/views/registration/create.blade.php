<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
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
            <h1>Register</h1>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('registration.store') }}" novalidate>
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                    @if($errors->has('name'))
                        <span class="error-message">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input id="lastname" type="text" class="form-control" name="lastname" required>
                    @if($errors->has('lastname'))
                        <span class="error-message">{{ $errors->first('lastname') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                    @if($errors->has('email'))
                        <span class="error-message">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                    @if($errors->has('password'))
                        <span class="error-message">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="currency">Currency</label>
                    <select id="currency" class="form-control" name="currency" required>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                    </select>
                    @if($errors->has('currency'))
                        <span class="error-message">{{ $errors->first('currency') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-green">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
