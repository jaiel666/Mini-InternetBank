<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Cryptocurrency</title>
    <link rel="stylesheet" href="{{ asset('css/sellcrypto.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
<div class="container">
    <h1>Sell Cryptocurrency</h1>

    @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form action="{{ route('cryptocurrencies.sell.post') }}" method="post">
        @csrf
        <div>
            <label for="crypto_id">Choose Cryptocurrency:</label>
            <select name="crypto_id" id="crypto_id" required>
                <option value="" disabled selected>Choose Cryptocurrency</option>
                @foreach ($userCryptocurrencies as $cryptoPortfolio)
                    <option value="{{ $cryptoPortfolio->cryptocurrency->id }}" data-balance="{{ $cryptoPortfolio->crypto_amount }}" data-price="{{ $cryptoPortfolio->cryptocurrency->price }}" data-symbol="{{ $cryptoPortfolio->cryptocurrency->symbol }}">
                        {{ $cryptoPortfolio->cryptocurrency->name }} ({{ $cryptoPortfolio->cryptocurrency->symbol }})
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="crypto_amount">Available Amount:</label>
            <span id="crypto_balance">--</span>
        </div>
        <div>
            <label for="sell_amount">Enter the amount to sell:</label>
            <input type="number" name="crypto_amount" id="crypto_amount" step="0.00000001" required>
        </div>
        <div>
            <span id="crypto_received">You will receive -- amount in {{ auth()->user()->currency }}</span>
        </div>
        <button type="submit">Sell</button>
    </form>

    <a href="{{ route('cryptocurrencies.index') }}">Back to Cryptocurrencies</a>
</div>

<script>
    $(document).ready(function () {
        $('#crypto_id').change(function () {
            var selectedCrypto = $('#crypto_id').find(':selected');
            var balance = parseFloat(selectedCrypto.data('balance'));
            var symbol = selectedCrypto.data('symbol') || '';
            $('#crypto_balance').text(balance + ' ' + symbol);
        });

        $('#crypto_id, #crypto_amount').on('input', function () {
            var selectedCrypto = $('#crypto_id').find(':selected');
            var price = parseFloat(selectedCrypto.data('price'));
            var cryptoAmountToSell = parseFloat($('#crypto_amount').val());

            if (!isNaN(cryptoAmountToSell)) {
                var amountToReceive = (cryptoAmountToSell * price).toFixed(2);
                $('#crypto_received').text('You will receive $' + amountToReceive);
            } else {
                $('#crypto_received').text('You will receive -- amount in USD');
            }
        });
    });
</script>

</body>

</html>
