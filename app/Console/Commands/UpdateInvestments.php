<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InvestmentAccount;
use App\Models\InvestmentHistory;

class UpdateInvestments extends Command
{
    protected $signature = 'update-investments';
    protected $description = 'Update investment accounts';

    public function handle()
    {
        $investmentAccounts = InvestmentAccount::all();

        foreach ($investmentAccounts as $account) {
            $this->info("Processing investment account ID: {$account->id}, Return Time: {$account->return_time}");

            if (is_numeric($account->return_time)) {
                $account->decrement('return_time');
                if ($account->return_time <= 0) {
                    $this->processReturn($account);
                }
            }
        }

        $this->info('Investments updated successfully.');
    }

    private function processReturn($account)
    {
        $user = $account->user;
        $expectedReturn = $account->return_amount;
        $user->account->increment('balance', $expectedReturn);
        InvestmentHistory::create([
            'user_id' => $user->id,
            'account_number' => $account->account_number,
            'balance' => $account->balance,
            'return_percentage' => $account->return_percentage,
            'return_amount' => $expectedReturn,
        ]);

        $this->info("Investment record added to history.");
        $account->delete();
        $this->info("Original investment record deleted.");
    }
}
