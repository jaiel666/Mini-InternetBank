<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptocurrencyPortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'cryptocurrency_id',
        'crypto_balance',
        'crypto_amount',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_number', 'account_number');
    }

    public function cryptocurrency()
    {
        return $this->belongsTo(Cryptocurrency::class, 'cryptocurrency_id');
    }
}
