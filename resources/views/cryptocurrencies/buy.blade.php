<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Cryptocurrency</title>
    <link rel="stylesheet" href="{{ asset('css/buycrypto.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
<div class="navbar">
    <div class="navbar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>
    <div class="navbar-links">
        <a href="{{ route('cryptocurrencies.index') }}">Back to Cryptocurrencies</a>
    </div>
</div>

<div class="container">
    <h1>Buy Cryptocurrency</h1>
    <form action="{{ route('cryptocurrencies.buy.post') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="crypto_symbol">Select Cryptocurrency:</label>
            <select name="crypto_symbol" id="crypto_symbol" required>
                <option value="" disabled selected>Choose Available Cryptocurrencies</option>
                @foreach($cryptocurrencies as $crypto)
                    <option value="{{ $crypto->symbol }}" data-price="{{ floatval($crypto->price) }}">
                        {{ $crypto->name }} ({{ $crypto->symbol }})
                    </option>
                @endforeach
            </select>
            @error('crypto_symbol')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="crypto_price">Price:</label>
            <p id="crypto_price">--</p>
        </div>

        <div class="form-group">
            <label for="crypto_amount">Enter the amount to buy:</label>
            <input type="number" name="crypto_amount" id="crypto_amount" step="0.00000001" required>
            @error('crypto_amount')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <p id="user_balance"> Your Available Balance: {{ auth()->user()->currency }} {{ number_format($userBalance, 2) }}</p>
        </div>

        <div class="form-group">
            <span id="crypto_received">You will receive -- amount of the selected cryptocurrency</span>
        </div>

        <button type="submit">Buy</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#crypto_symbol, #crypto_amount').change(function () {
            var selectedCrypto = $('#crypto_symbol').find(':selected');
            var price = selectedCrypto.data('price');
            $('#crypto_price').text('$' + price.toFixed(2));

            var cryptoAmountToBuy = $('#crypto_amount').val();
            if (cryptoAmountToBuy !== '') {
                var amountToReceive = (cryptoAmountToBuy / price).toFixed(8);
                $('#crypto_received').text('You will receive ' + amountToReceive + ' amount of the selected cryptocurrency');
            } else {
                $('#crypto_received').text('You will receive -- amount of the selected cryptocurrency');
            }
        });
    });
</script>
</body>

</html>
