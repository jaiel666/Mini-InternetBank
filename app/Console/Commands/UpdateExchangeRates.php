<?php
namespace App\Console\Commands;

use App\Models\ExchangeRate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateExchangeRates extends Command
{
    protected $signature = 'exchange-rates:update-specific';
    protected $description = 'Fetch and update specific exchange rates';

    public function handle()
    {
        $currencies = ['USD', 'EUR'];

        foreach ($currencies as $baseCurrency) {
            $exchangeCurrencies = array_diff($currencies, [$baseCurrency]);

            foreach ($exchangeCurrencies as $exchangeCurrency) {
                $response = Http::withOptions([
                    'verify' => false,
                ])->get("https://api.coinbase.com/v2/exchange-rates?currency={$baseCurrency}");

                if ($response->successful()) {
                    $rate = $response->json()['data']['rates'][$exchangeCurrency];

                    ExchangeRate::updateOrCreate(
                        ['base_currency' => $baseCurrency, 'exchange_currency' => $exchangeCurrency],
                        ['rate' => $rate]
                    );

                    $this->info("Exchange rate updated successfully for $baseCurrency to $exchangeCurrency.");
                } else {
                    $this->error("Failed to fetch exchange rate for $baseCurrency to $exchangeCurrency.");
                }
            }
        }

        $this->info('Exchange rates updated successfully.');
    }
}
