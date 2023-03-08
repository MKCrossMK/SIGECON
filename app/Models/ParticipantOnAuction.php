<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantOnAuction extends Model
{
    use HasFactory;

    protected $fillable = [
        'auction_participant_id',
        'number_paddle',
        'auction_id', 
    ];

    public function auctionParticipant(){
        return $this->belongsTo(AuctionParticipant::class, 'auction_participant_id', 'id');
    }

    public function policiesBought(){
        return $this->hasMany(AuctionDetail::class,'participant_on_auctions_id', 'id' );
    }

    public function auction(){
        return $this->belongsTo(Auction::class, 'auction_id', 'id');
    }



}
