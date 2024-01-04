<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Funds</title>
    <link rel="stylesheet" href="{{ asset('css/transfer.css') }}">
</head>
<body>

<nav class="navbar">
    <div class="navbar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="navbar-links">
        <a href="{{ route('user_main_page') }}">Back to User Main Page</a>
    </div>
</nav>

<div class="container">
    <h1>Transfer Funds</h1>

    <form method="POST" action="{{ route('user_main_page.transfer_funds') }}">
        @csrf

        <div class="form-group">
            <label for="sender_account_number">Your Account Number</label>
            <input type="text" id="sender_account_number" name="sender_account_number" value="{{ auth()->user()->account->account_number }}" readonly>
        </div>

        <div class="form-group">
            <label for="recipient_account_number">Recipient's Account Number</label>
            <input type="text" id="recipient_account_number" name="recipient_account_number" required>
            @error('recipient_account_number')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount" step="0.01" required>
            <p>Available Balance: {{ auth()->user()->currency }} {{ auth()->user()->account->balance }}</p>
            @error('amount')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="reason">Transfer Reason</label>
            <input type="text" id="reason" name="reason" required>
            @error('reason')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Transfer</button>
    </form>
</div>

</body>
</html>
