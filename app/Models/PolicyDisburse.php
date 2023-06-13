<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyDisburse extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'amount',
        'user_id',
        'cash_id'
    ];
}
