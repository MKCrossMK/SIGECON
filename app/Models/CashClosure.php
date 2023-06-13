<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashClosure extends Model
{
    use HasFactory;

    protected $fillable = [
        'cash_id',
        'initial_amount',
        'income',
        'expense',
        'cash_id',
    ];
}
