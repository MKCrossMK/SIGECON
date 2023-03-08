<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldPolicyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'old_policy_id',
        'image',
        'description',
        'carat',
        'stone_type',
        'weight',
        'valued_price',
        'loan_price',
    ];

    
    public function policy(){
        return $this->belongsTo(OldPolicy::class, 'old_policy_id', 'id');
    }
}
