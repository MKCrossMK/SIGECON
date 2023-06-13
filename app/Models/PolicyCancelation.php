<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyCancelation extends Model
{
    use HasFactory;
    protected $fillable = [
        'policy_id',
        'user_id',
        'branch_offices_id',
        'interest_rate_paid',
        'contract_rate_paid',
        'capital_paid',
        'amount',
        'date_paid',
    ];

    public function policy(){
        return $this->belongsTo(Policy::class, 'policy_id', 'id');
    }
}
