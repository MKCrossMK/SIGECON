<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cash extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'branch_office_id',
        'initial_amount',
        'balance',
    ];


    public function branchOffice()
    {
        return $this->belongsTo(Branch_Office::class, 'branch_office_id', 'id');
    }
}
