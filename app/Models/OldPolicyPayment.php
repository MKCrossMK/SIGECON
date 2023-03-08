<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldPolicyPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'user_id',
        // 'interest_rate_paid',
        // 'interest_rate_paid_residuary',
        // 'cp_interest_rate_paid_residuary',
        // 'contract_rate_paid',
        // 'contract_rate_paid_residuary',
        // 'cp_contract_rate_paid_residuary',
        // 'capital_paid',
        // 'capital_paid_residuary',
        // 'cp_capital_paid_residuary',
        'amount',
        'payment_note',
        'date_paid',
    ];

    public function policy(){
        return $this->belongsTo(OldPolicy::class, 'policy_id', 'id');
    }
}
