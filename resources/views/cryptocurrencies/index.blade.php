<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cryptocurrency Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/cryptocurrency.css') }}">
</head>

<body>
<div class="navbar">
    <div class="navbar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="navbar-links">
        <a href="{{ route('user_main_page') }}">Back to User Page</a>
    </div>
</div>

<div class="container">
    <h1>Cryptocurrency Dashboard</h1>
    <h2>Available cryptocurrencies</h2>

    @if($cryptocurrencies->isEmpty())
        <p>No cryptocurrencies available.</p>
    @else
        <div class="cryptocurrencies">
            @foreach($cryptocurrencies as $crypto)
                <div class="crypto-item">
                    <p>Name: {{ $crypto->name }}</p>
                    <p>Symbol: {{ $crypto->symbol }}</p>
                    <p>Price (USD): ${{ number_format($crypto->price, 2) }}</p>
                </div>
            @endforeach
        </div>
    @endif

    {{ $cryptocurrencies->links() }}

    <div class="crypto-balance">
        <h2>Your Crypto Portfolio</h2>

        @if(optional($cryptoPortfolios)->isNotEmpty())
            @php
                $cryptoPortfoliosGrouped = $cryptoPortfolios->groupBy('cryptocurrency_id');
            @endphp

            <div class="crypto-cards">
                @foreach($cryptoPortfoliosGrouped as $cryptoId => $portfolios)
                    @php
                        $totalBalance = $portfolios->sum('crypto_balance');
                        $totalCryptoAmount = $portfolios->sum('crypto_amount');
                        $crypto = $portfolios->first()->cryptocurrency;
                        $status = $portfolios->first()->status;
                    @endphp

                    <div class="crypto-card" style="color: {{ $status === 'profit' ? 'green' : ($status === 'loss' ? 'red' : 'black') }}">
                        <h3>{{ $crypto->name }} ({{ $crypto->symbol }})</h3>
                        <p>Your Crypto Balance:<br> {{ $user->currency }} {{ $totalBalance }}</p>
                        <p>Your Crypto Amount: {{ $totalCryptoAmount }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p>No crypto portfolio available for this user.</p>
        @endif
    </div>
    <a href="{{ route('cryptocurrencies.buy') }}" class="btn btn-success">Buy Crypto</a>
    <a href="{{ route('cryptocurrencies.sell') }}" class="btn btn-success">Sell Crypto</a>

</div>
</body>
</html>
