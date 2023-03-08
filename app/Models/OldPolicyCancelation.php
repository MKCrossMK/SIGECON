<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldPolicyCancelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'user_id',
        'date_paid',
        'amount',
        // 'description',
    ];
    public function policy(){
        return $this->belongsTo(OldPolicy::class, 'policy_id', 'id');
    }
}
