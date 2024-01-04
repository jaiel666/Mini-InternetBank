<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'balance',
        'return_percentage',
        'return_amount',
    ];

    public function user()
    {
        return $this->belongsTo(Registration::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_number', 'account_number');
    }
}
