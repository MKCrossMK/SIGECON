<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuctionDetail extends Model
{
    use HasFactory;

    const STATUS_TO_AUCTION = "Subastar";
    const STATUS_AUCTIONED = "Subastada";

    const AWARD_MDP = "MPD";
    
    protected $fillable = [
        'auction_id',
        'policy_id',
        'policie_class_name',
        'user_creator_id',
        'first_bid_price',
        'auctioned_price',
        'status',
        'participant_on_auctions_id'
    ];


    public function auction(){
        return $this->BelongsTo(Auction::class, 'auction_id', 'id');
    }


    public function policy(){
       return $this->policie_class_name::find($this->policy_id);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_creator_id', 'id');
    }

    public function buyer(){
        return $this->belongsTo(ParticipantOnAuction::class, 'participant_on_auctions_id', 'id');
    }
}
