<?php

namespace App\Http\Controllers;

use App\Models\InvestmentAccount;
use App\Models\InvestmentHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class InvestmentAccountController extends Controller
{
    public function create()
    {
        return view('investment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'balance' => 'required|numeric|min:0.01|max:' . auth()->user()->account->balance,
            'return_time' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        $durationWeeks = $request->input('return_time', 0);
        $balanceToInvest = $request->input('balance', 0);

        if ($balanceToInvest < 0.01) {
            return redirect()->back()->with('error', 'Investment amount must be at least 0.01.');
        }

        if ($balanceToInvest > $user->account->balance) {
            return redirect()->back()->with('error', 'Insufficient balance for the investment.');
        }

        $user->account->decrement('balance', $balanceToInvest);

        $weeklyReturnRate = 0.05;
        $expectedReturn = $balanceToInvest * (1 + $weeklyReturnRate * $durationWeeks);

        $returnPercentage = ($expectedReturn - $balanceToInvest) / $balanceToInvest * 100;

        $investment = InvestmentAccount::create([
            'user_id' => $user->id,
            'account_number' => $user->account->account_number,
            'balance' => $balanceToInvest,
            'return_time' => $durationWeeks,
            'return_percentage' => $returnPercentage,
            'return_amount' => $expectedReturn,
        ]);

        return redirect()->route('investment.index')->with('success', 'Investment account created successfully.');
    }

    public function index()
    {
        $investmentAccounts = InvestmentAccount::where('user_id', auth()->user()->id)->get();

        return view('investment.index', compact('investmentAccounts'));
    }

    public function investmentHistory()
    {
        $investmentHistory = InvestmentHistory::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        Paginator::useBootstrap();

        return view('investment.history', compact('investmentHistory'));
    }
}
