<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Cryptocurrency;
use App\Models\CryptocurrencyPortfolio;

class UpdateCryptocurrencies extends Command
{
    protected $signature = 'update-cryptocurrencies';
    protected $description = 'Fetch and update cryptocurrency prices';

    public function handle()
    {
        $apiKey =  env('COINMARKETCAP_API_KEY');
        $limit = 50;

        $response = Http::withOptions(['verify' => false])
            ->get("https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest", [
                'CMC_PRO_API_KEY' => $apiKey,
                'limit' => $limit,
                'convert' => 'USD',
            ]);

        if ($response->successful()) {
            $cryptocurrenciesData = $response->json()['data'];

            foreach ($cryptocurrenciesData as $cryptoData) {
                $symbol = $cryptoData['symbol'];
                $newPrice = $cryptoData['quote']['USD']['price'];
                $cryptocurrency = Cryptocurrency::where('symbol', $symbol)->first();

                if (!$cryptocurrency) {
                    $cryptocurrency = new Cryptocurrency([
                        'name' => $cryptoData['name'],
                        'symbol' => $symbol,
                        'price' => $newPrice,
                    ]);
                } else {
                    $cryptocurrency->update([
                        'name' => $cryptoData['name'],
                        'price' => $newPrice,
                    ]);
                }
                $cryptocurrency->save();
            }

            $this->info('Cryptocurrencies updated successfully.');
        } else {
            $this->error('Failed to fetch cryptocurrency data.');
        }
    }
}
