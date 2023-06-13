<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OldPolicy extends Model
{
    const STATUS_APPROVED= "Aprobada";
    const STATUS_RENOVATED = "Renovada";
    const STATUS_CANCELED = "Cancelada";
    const STATUS_EXPIRED = "Vencida";
    const STATUS_TO_AUCTION = "Subastar";
    const STATUS_AUCTIONED = "Subastada";
    const STATUS_DELETED = "Eliminada";

    use HasFactory;

    protected $fillable = [
        'id',
        'number_policy',
        'date_start',
        'date_end',
        // 'last_updated_interest',
        // 'last_updated_contract',
        'client_id',
        'loan_value',
        'validity_months',
        'interest_rate',
        'base_interest_rate',
        'contract_rate',
        'base_contract_rate',
        'capital_pay',
        'base_capital_pay',
        'interest_pay',
        // 'c_interest_pay',
        // 'base_interest_pay',
        'contract_pay',
        // 'c_contract_pay',
        // 'base_contract_pay',
        'note_policy',
        'user_id',
        'referrer_id',
        'branch_offices_id',
        'status',
        'status_credit_pay',
        'status_renovation',
        'status_cancelation',
        'place_vault',
    ];



    public function policyDetails(){
        return $this->hasMany(OldPolicyDetail::class);
    }

    public function clients(){
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function referrer(){
        return $this->belongsTo(OldPolicyReferrer::class, 'referrer_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function branch_office(){
        return $this->belongsTo(Branch_Office::class, 'branch_offices_id', 'id');
    }

    public function creditPay(){
        return $this->hasMany(OldPolicyPayment::class, 'policy_id', 'id');
    }

    public function renovations(){
        return $this->hasMany(OldPolicyRenovation::class, 'policy_id', 'id');
    }

    public function cancelations(){
        return $this->hasMany(OldPolicyCancelation::class, 'policy_id', 'id');
    }

    
}
