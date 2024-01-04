<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Investment Account</title>
    <link rel="stylesheet" href="{{ asset('css/investment_create.css') }}">
</head>
<body>
<nav class="navbar">
    <div class="navbar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="navbar-links">
        <a href="{{ route('investment.index') }}">Back to Investment Page</a>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Create Investment Account</h2>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('investment.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="balance">Initial Balance:</label>
                    <input type="number" name="balance" id="balance" class="form-control" required>
                    @error('balance')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <p>Available Balance: {{ auth()->user()->currency }} {{ auth()->user()->account->balance }}</p>
                </div>

                <div class="form-group">
                    <label for="return_time">Investment Duration (weeks):</label>
                    <input type="number" name="return_time" id="return_time" class="form-control" required>
                    @error('return_time')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <p>Expected Return: {{ auth()->user()->currency }} <span id="expected_return">0.00</span></p>
                </div>

                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('return_time').addEventListener('input', updateExpectedReturn);

    function updateExpectedReturn() {
        const balance = parseFloat(document.getElementById('balance').value);
        const returnTime = parseInt(document.getElementById('return_time').value);
        const weeklyReturn = 0.05;

        const expectedReturn = balance * (1 + weeklyReturn * returnTime);
        document.getElementById('expected_return').innerText = expectedReturn.toFixed(2);
    }
</script>

</body>

</html>
