<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyRenovation extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'user_id',
        'interest_rate_paid',
        // 'interest_rate_paid_residuary',
        'contract_rate_paid',
        // 'contract_rate_paid_residuary',
        // 'capital_paid',
        // 'capital_paid_residuary',
        'amount',
        'date_paid',
    ];

    public function policy(){
        return $this->belongsTo(Policy::class, 'policy_id', 'id');
    }
}
