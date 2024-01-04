<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CryptocurrencyPortfolio;

class UpdateBalances extends Command
{
    protected $signature = 'update-balances';
    protected $description = 'Update cryptocurrency portfolio balances and amounts';

    public function handle()
    {
        $portfolios = CryptocurrencyPortfolio::all();

        foreach ($portfolios as $portfolio) {
            $crypto = $portfolio->cryptocurrency;
            $newBalance = $crypto->price * $portfolio->crypto_amount;
            $newAmount = $newBalance / $crypto->price;
            $formattedBalance = number_format($newBalance, 2, '.', '');
            $portfolio->update([
                'crypto_balance' => $formattedBalance,
                'crypto_amount' => $newAmount,
            ]);
        }

        $this->info('Cryptocurrency balances and amounts updated successfully.');
    }
}
