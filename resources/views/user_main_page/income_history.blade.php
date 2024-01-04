<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income History</title>
    <link rel="stylesheet" href="{{ asset('css/income_history.css') }}">
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
    <h1>Income History</h1>

    @if($incomingTransfers->isEmpty())
        <p>No income history available.</p>
    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Sender Account Number</th>
                <th>Amount (User Currency)</th>
                <th>Transfer Reason</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($incomingTransfers as $transfer)
                <tr>
                    <td>{{ $transfer->sender_account_number }}</td>
                    <td>{{ auth()->user()->currency }} {{ $transfer->amount }}</td>
                    <td>{{ $transfer->reason }}</td>
                    <td>{{ $transfer->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $incomingTransfers->links() }}
    @endif
</div>
</body>

</html>
