<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch_Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'direccion',
        'province',
        'case_back',
        'availability',

    ];
}
