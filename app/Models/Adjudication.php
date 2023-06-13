<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjudication extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_id',
        'auction_detail_id',
    ];


    public function auctionDetail(){
        return $this->belongsTo(AuctionDetail::class, 'auction_detail_id', 'id');
    }
}
