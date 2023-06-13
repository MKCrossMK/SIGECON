<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashHistory extends Model
{
    use HasFactory;

    const UPDATE_REASON = 'Actualizado';
    const CLOSURE_REASON = 'Cierre de Caja';

    protected $fillable = [
        'cash_id',
        'balance',
        'reason'
    ];
}
