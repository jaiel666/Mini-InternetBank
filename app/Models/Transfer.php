<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_account_number',
        'receiver_account_number',
        'amount',
        'reason',
    ];

    public function senderAccount()
    {
        return $this->belongsTo(Account::class, 'sender_account_number', 'account_number');
    }

    public function receiverAccount()
    {
        return $this->belongsTo(Account::class, 'receiver_account_number', 'account_number');
    }
}
