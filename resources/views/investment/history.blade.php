<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment History</title>
    <link rel="stylesheet" href="{{ asset('css/investment_history.css') }}">
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
    <h2>Investment History</h2>

    @if($investmentHistory->isEmpty())
        <p>No investment history found.</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Account Number</th>
                <th>Initial Balance</th>
                <th>Return Percentage</th>
                <th>Return Amount</th>
                <th>Received At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($investmentHistory as $history)
                <tr>
                    <td>{{ $history->account_number }}</td>
                    <td>{{ auth()->user()->currency }} {{ number_format($history->balance, 2) }}</td>
                    <td>{{ $history->return_percentage }}%</td>
                    <td>{{ auth()->user()->currency }} {{ number_format($history->return_amount, 2) }}</td>
                    <td>{{ $history->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $investmentHistory->links() }}
    @endif
</div>
</body>

</html>
