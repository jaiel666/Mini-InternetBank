<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Cryptocurrency;
use App\Models\CryptocurrencyPortfolio;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CryptocurrencyController extends Controller
{
    public function index()
    {
        $cryptocurrencies = Cryptocurrency::paginate(5);

        Paginator::useBootstrap();

        $user = Auth::user();
        $cryptoPortfolios = CryptocurrencyPortfolio::where('account_number', $user->account->account_number)->get();
        $cryptoPortfolio = $cryptoPortfolios->first();

        return view('cryptocurrencies.index', compact('cryptocurrencies', 'cryptoPortfolios', 'cryptoPortfolio', 'user'));
    }

    public function showBuyForm()
    {
        $cryptocurrencies = Cryptocurrency::all();
        $user = Auth::user();
        $userBalance = Account::where('user_id', $user->id)->value('balance');

        return view('cryptocurrencies.buy', compact('cryptocurrencies', 'userBalance'));
    }

    public function buyCrypto(Request $request)
    {
        $request->validate([
            'crypto_symbol' => 'required|string|exists:cryptocurrencies,symbol',
            'crypto_amount' => 'required|numeric|min:0.01|max:' . auth()->user()->account->balance,
        ]);

        $user = Auth::user();
        $cryptoSymbol = $request->input('crypto_symbol');
        $cryptoAmountToBuy = $request->input('crypto_amount');

        $crypto = Cryptocurrency::where('symbol', $cryptoSymbol)->first();

        if ($crypto) {
            $existingPortfolio = CryptocurrencyPortfolio::where('account_number', $user->account->account_number)
                ->where('cryptocurrency_id', $crypto->id)
                ->first();

            $totalPrice = $cryptoAmountToBuy;
            if ($user->account->balance >= $totalPrice) {
                $user->account->balance -= $totalPrice;
                $user->account->save();

                if ($existingPortfolio) {
                    $existingPortfolio->crypto_balance += $cryptoAmountToBuy;
                    $existingPortfolio->crypto_amount += $cryptoAmountToBuy / $crypto->price;
                    $existingPortfolio->save();
                } else {
                    CryptocurrencyPortfolio::create([
                        'account_number' => $user->account->account_number,
                        'cryptocurrency_id' => $crypto->id,
                        'crypto_balance' => $cryptoAmountToBuy,
                        'crypto_amount' => $cryptoAmountToBuy / $crypto->price,
                    ]);
                }

                return redirect()->route('cryptocurrencies.index')->with('success', 'Cryptocurrency bought successfully.');
            }
        }

        return redirect()->route('cryptocurrencies.buy')->withInput()->with('error', 'Invalid cryptocurrency or insufficient funds.');
    }


    public function sellPage()
    {
        $user = auth()->user();
        $userCryptocurrencies = CryptocurrencyPortfolio::where('account_number', $user->account->account_number)->get();

        return view('cryptocurrencies.sell', compact('userCryptocurrencies'));
    }

    public function sell(Request $request)
    {
        $request->validate([
            'crypto_id' => 'required|exists:cryptocurrency_portfolios,cryptocurrency_id',
            'crypto_amount' => 'required|numeric|min:0.01'
        ]);

        $cryptoId = $request->input('crypto_id');
        $cryptoAmountToSell = $request->input('crypto_amount');

        $user = auth()->user();
        $cryptoPortfolio = CryptocurrencyPortfolio::where('account_number', $user->account->account_number)
            ->where('cryptocurrency_id', $cryptoId)
            ->first();

        if (!$cryptoPortfolio) {
            return redirect()->route('cryptocurrencies.sell')->with('error', 'Cryptocurrency not found in your portfolio.');
        }

        if ($cryptoAmountToSell > 0 && $cryptoAmountToSell <= $cryptoPortfolio->crypto_amount) {
            $crypto = Cryptocurrency::findOrFail($cryptoId);
            $sellingPrice = $crypto->price * $cryptoAmountToSell;

            $user->account->balance += $sellingPrice;
            $user->account->save();

            $cryptoPortfolio->crypto_amount -= $cryptoAmountToSell;
            $cryptoPortfolio->crypto_balance -= $sellingPrice;
            $cryptoPortfolio->save();

            if ($cryptoPortfolio->crypto_amount == 0) {
                $cryptoPortfolio->delete();
            }

            return redirect()->route('cryptocurrencies.sell')->with('success', 'Cryptocurrency sold successfully.');
        }

        return redirect()->route('cryptocurrencies.sell')->with('error', 'Invalid cryptocurrency amount to sell.');
    }
}
