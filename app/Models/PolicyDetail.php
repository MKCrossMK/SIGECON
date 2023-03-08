<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'image',
        'description',
        'carat',
        'stone_type',
        'weight',
        'valued_price',
        'loan_price',
    ];

    
    public function policy(){
        return $this->belongsTo(Policy::class, 'policy_id', 'id');
    }

}
