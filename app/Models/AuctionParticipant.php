<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuctionParticipant extends Model
{
    use HasFactory;

    const MDP = ['name' => 'Monte de Piedad', 'cedula' => '401007632'];

    protected $fillable = [
        'name',
        'cedula',
        'user_creator_id'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_creator_id', 'id');
    }

    public function participantTo(){
        $auction_id = Auction::latest()->select('id')->where('status', 1)->first();
       return ParticipantOnAuction::where('auction_participant_id', $this->id)->where('auction_id', $auction_id->id)->first();


    }
}
