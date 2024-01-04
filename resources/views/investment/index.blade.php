<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Investment Accounts</title>
    <link rel="stylesheet" href="{{ asset('css/investment_page.css') }}">

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
    <h2>My Investment Accounts</h2>

    @if($investmentAccounts->isEmpty())
        <p>No investment accounts found.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Account Number</th>
                <th>Initial Balance</th>
                <th>Return time</th>
                <th>Return Percentage</th>
                <th>Return Amount</th>
            </tr>
            </thead>
            <tbody>
            @foreach($investmentAccounts as $account)
                <tr>
                    <td>{{ $account->account_number }}</td>
                    <td>{{ auth()->user()->currency }} {{ number_format($account->balance, 2) }}</td>
                    <td>{{ $account->return_time}} week(s)</td>
                    <td>{{ $account->return_percentage }}%</td>
                    <td>{{ auth()->user()->currency }} {{ number_format($account->return_amount, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <div class="info-section">
        <h3>Understanding Investment Returns</h3>
        <p>
            Investing involves committing money or capital with the expectation of obtaining additional income or profit.
            In this system, your initial balance grows over time based on a return percentage and investment duration.
        </p>

        <h4>Example:</h4>
        <p>
            Let's say you create an investment account with an initial balance of $1,000, a return percentage of 5% per week,
            and an investment duration of 4 weeks. Here's how the return is calculated:
        </p>

        <ul>
            <li>Initial Balance: $1,000</li>
            <li>Return Percentage: 5% per week</li>
            <li>Investment Duration: 4 weeks</li>
        </ul>

        <p>
            The expected return amount is calculated as follows:
            Expected Return = Initial Balance * (1 + Return Percentage * Investment Duration)
        </p>

        <p>
            In the above example:
            Expected Return = $1,000 * (1 + 0.05 * 4) = $1,200
        </p>

        <p>
            After the 4-week duration, your account balance will grow to $1,200, and the return amount will be $200.
        </p>

        <p>
            This is a simplified example, and actual returns may vary based on the specific terms and conditions of the investment.
        </p>
    </div>
    <a href="{{ route('investment.create') }}" class="btn btn-success">Create New Account</a>
    <a href="{{ route('investment.history') }}" class="btn btn-success">Investment History</a>
</div>
</body>

</html>
