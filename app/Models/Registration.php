<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Registration extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'registration';

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'currency',
    ];

    protected $hidden = [
        'password',
    ];

    public function account()
    {
        return $this->hasOne(Account::class, 'user_id');
    }

}

