<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyReferrer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula',
        'name',
        'phone',
        'address',
        'note',
        'user_id',
    ];

    public function policy(){
        return $this->belongsTo(Policy::class);
    
    }


}
