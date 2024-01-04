<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_number',
        'balance',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($account) {
            $account->account_number = mt_rand(100000000000, 999999999999);
        });
    }

    public function user()
    {
        return $this->belongsTo(Registration::class);
    }
}
