<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page - Internet Bank</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar">
    <div class="navbar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="navbar-links">
        <a href="{{ route('registration.create') }}">Register</a>
        <a href="{{ route('login.create') }}">Login</a>
    </div>
</nav>

<div class="container">
    <h1>Welcome to the Internet Bank</h1>
    <p>This is your one-stop solution for secure and convenient online banking. Manage your accounts, transfer funds, and invest with ease.</p>
    <h2>Why Choose Us?</h2>
    <ul>
        <li>Secure and Encrypted Transactions</li>
        <li>24/7 Access to Your Accounts</li>
        <li>Investment Opportunities</li>
        <li>Competitive Exchange Rates</li>
    </ul>
    <h2>Our Services</h2>
    <p>Explore a wide range of banking services tailored to meet your financial needs:</p>
    <ul>
        <li>Online Account Management</li>
        <li>Quick Fund Transfers</li>
        <li>Personalized Investment Portfolios</li>
        <li>Foreign Currency Exchange</li>
    </ul>
    <p>Join us and experience the future of banking!</p>
</div>

</body>
</html>
