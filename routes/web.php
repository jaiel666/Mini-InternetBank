<?php

use App\Http\Controllers\InvestmentAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserMainPageController;
use App\Http\Controllers\CryptocurrencyController;

Route::get('/', function () {
    return view('main_page');
})->name('main_page');

Route::get('/register', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/register', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::get('/user_main_page/logout', [UserMainPageController::class, 'logout'])->name('user_main_page.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/user-main-page', [UserMainPageController::class, 'index'])->name('user_main_page');
});

Route::get('/user-main-page/transfer', [UserMainPageController::class, 'showTransferForm'])->name('user_main_page.transfer');
Route::post('/user-main-page/transfer', [UserMainPageController::class, 'transferFunds'])->name('user_main_page.transfer_funds');
Route::get('/user-main-page/transfer-history', [UserMainPageController::class, 'showTransferHistory'])->name('user_main_page.transfer_history');



Route::get('/cryptocurrencies', [CryptocurrencyController::class, 'index'])
    ->name('cryptocurrencies.index');

Route::get('/profile', [UserMainPageController::class, 'profile'])
    ->name('user_main_page.profile')
    ->middleware('auth');

Route::get('/cryptocurrencies/buy', [CryptocurrencyController::class, 'showBuyForm'])->name('cryptocurrencies.buy');
Route::post('/cryptocurrencies/buy', [CryptocurrencyController::class, 'buyCrypto'])->name('cryptocurrencies.buy.post');

Route::get('/cryptocurrencies/sell', [CryptocurrencyController::class, 'sellPage'])->name('cryptocurrencies.sell');
Route::post('/cryptocurrencies/sell', [CryptocurrencyController::class, 'sell'])->name('cryptocurrencies.sell.post');


Route::get('/investment-accounts/create', [InvestmentAccountController::class, 'create'])->name('investment.create');

Route::post('/investment-accounts', [InvestmentAccountController::class, 'store'])->name('investment.store');

Route::get('/investment-accounts', [InvestmentAccountController::class, 'index'])->name('investment.index');
Route::get('/investment/history', [InvestmentAccountController::class, 'investmentHistory'])->name('investment.history');
Route::get('/income-history', [UserMainPageController::class, 'incomeHistory'])->name('user_main_page.income_history');


