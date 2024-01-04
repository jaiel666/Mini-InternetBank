<?php

namespace App\Http\Controllers;

use App\Models\Cryptocurrency;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:registration,email',
            'password' => 'required|min:8',
            'currency' => 'required',
        ]);

        $user = Registration::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'currency' => $request->currency,
        ]);

        $user->account()->create([
            'account_number' => $this->generateAccountNumber(),
            'balance' => 0.00,
        ]);

        session()->flash('success', 'Account created successfully! Please log in.');

        return redirect()->route('main_page')->with('success', 'Account created successfully! Please log in.');
    }

    private function generateAccountNumber()
    {
        return Str::random(12);
    }
}

