<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserMainPageController extends Controller
{
    public function index()
    {
        return view('user_main_page');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function showTransferForm()
    {
        return view('user_main_page.transfer');
    }

    private function getExchangeRate($fromCurrency, $toCurrency)
    {
        return ExchangeRate::where('base_currency', $fromCurrency)
            ->where('exchange_currency', $toCurrency)
            ->value('rate');
    }

    public function transferFunds(Request $request)
    {
        $request->validate([
            'recipient_account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:0.01|max:' . auth()->user()->account->balance,
            'reason' => 'required',
        ]);

        if (!auth()->check()) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }
        $user = auth()->user();

        $userAccount = $user->account;
        if (!$userAccount) {
            return redirect()->back()->with('error', 'User account not found.');
        }

        $userCurrency = $user->currency;
        $recipientAccount = Account::where('account_number', $request->input('recipient_account_number'))->first();

        if (!$recipientAccount) {
            return redirect()->back()->with('error', 'Recipient account not found.');
        }
        $recipientCurrency = $recipientAccount->user->currency;

        if ($userCurrency !== $recipientCurrency) {
            $exchangeRate = $this->getExchangeRate($userCurrency, $recipientCurrency);

            if (!$exchangeRate) {
                return redirect()->back()->with('error', 'Exchange rate not available for currencies: ' . $userCurrency . ' to ' . $recipientCurrency);
            }

            $transferAmount = $request->input('amount');
            $convertedAmount = $transferAmount * $exchangeRate;

            if ($userAccount->balance < $transferAmount) {
                return redirect()->back()->with('error', 'Insufficient funds.');
            }

            $userAccount->decrement('balance', $transferAmount);
            $recipientAccount->increment('balance', $convertedAmount);

            Transfer::create([
                'sender_account_number' => $userAccount->account_number,
                'receiver_account_number' => $recipientAccount->account_number,
                'amount' => $convertedAmount,
                'reason' => $request->input('reason'),
            ]);

            return redirect()->route('user_main_page')->with('success', 'Funds transferred successfully!');
        }

        $transferAmount = $request->input('amount');

        if ($userAccount->balance < $transferAmount) {
            return redirect()->back()->with('error', 'Insufficient funds.');
        }

        $userAccount->decrement('balance', $transferAmount);
        $recipientAccount->increment('balance', $transferAmount);

        Transfer::create([
            'sender_account_number' => $userAccount->account_number,
            'receiver_account_number' => $recipientAccount->account_number,
            'amount' => $transferAmount,
            'reason' => $request->input('reason'),
        ]);

        return redirect()->route('user_main_page')->with('success', 'Funds transferred successfully!');
    }

    public function showTransferHistory()
    {
        $transfers = Transfer::orderBy('created_at', 'desc')->paginate(10);

        Paginator::useBootstrap();

        return view('user_main_page.transfer_history', ['transfers' => $transfers]);
    }

    public function incomeHistory()
    {
        $incomingTransfers = Transfer::where('receiver_account_number', auth()->user()->account->account_number)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        Paginator::useBootstrap();

        return view('user_main_page.income_history', compact('incomingTransfers'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user_main_page.profile', compact('user'));
    }
}
