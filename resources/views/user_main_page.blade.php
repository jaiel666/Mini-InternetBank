<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Main Page</title>
    <link rel="stylesheet" href="{{ asset('css/user_main_page.css') }}">
</head>
<body>

<nav class="navbar">
    <div class="navbar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="navbar-links">
        <div class="user-info">
            <span class="welcome-msg">Welcome, {{ auth()->user()->name }}</span>
            <span class="account-info">Account Number: {{ auth()->user()->account->account_number }}</span>
        </div>
        <div class="navbar-actions">
            <a href="{{ route('user_main_page.profile') }}">Profile</a>
            <a href="{{ route('user_main_page.logout') }}">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="main-box">
        <div class="welcome-section">
            <h1>Welcome to Your Profile {{ auth()->user()->name }}</h1>
        </div>

        <div class="user-details">
            <div class="balance-info">
                <p>Your Balance:</p>
                <p class="balance-amount">{{ Auth::user()->currency }} {{ number_format(Auth::user()->account->balance, 2) }}</p>
            </div>

            <div class="actions">
                <a href="{{ route('user_main_page.transfer') }}" class="btn btn-blue">Transfer Funds</a>
                <a href="{{ route('cryptocurrencies.index') }}" class="btn btn-blue">Cryptocurrency Wallet</a>
                <a href="{{ route('investment.index') }}" class="btn btn-blue">View Investment Accounts</a>
                <a href="{{ route('user_main_page.transfer_history') }}" class="btn btn-blue">View Transfer History</a>
                <a href="{{ route('user_main_page.income_history') }}" class="btn btn-blue">View Income History</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
