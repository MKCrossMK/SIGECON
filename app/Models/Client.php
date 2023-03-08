<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'cedula',
        'name',
        'lastname', 
        'address',
        'phone',
        'cellphone',
        'email',
        'sex',
        'civil_status'
    ];
}
