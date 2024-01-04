<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer History</title>
    <link rel="stylesheet" href="{{ asset('css/transfer_history.css') }}">

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
    <h1>Transfer History</h1>

    @if($transfers->isEmpty())
        <p>No transfer history available.</p>
    @else
        <table>
            <thead>
            <tr>
                <th>Date</th>
                <th>Recipient Account</th>
                <th>Amount</th>
                <th>Reason</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transfers as $transfer)
                <tr>
                    <td>{{ $transfer->created_at }}</td>
                    <td>{{ $transfer->receiverAccount->account_number }}</td>
                    <td>{{ $transfer->amount }}</td>
                    <td>{{ $transfer->reason }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $transfers->links() }}
    @endif
</div>

</body>
</html>
