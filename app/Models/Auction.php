<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    const STATUS_CREATED = "Creada";
    const STATUS_STARTED= "Iniciada";
    const STATUS_CLOSED = "Concluida";
   

    use HasFactory;

    protected $fillable = [
        'date_to_celebrate',
        'note',
        'places',
        'amount_to_auction',
        'branch_office_celebrate_id',
        'qty_policies_published',
        'total_auctioned',
        'total_not_auctioned',
        'qty_policies_auctioned',
        'user_creator_id',
        'status',
    ];


    public function details(){
       return $this->hasMany(AuctionDetail::class, 'auction_id', 'id');
    }

    public function participants(){
        return $this->hasMany(ParticipantOnAuction::class, 'auction_id', 'id');
    }

    public function branchOffice(){
        return $this->belongsTo(Branch_Office::class, 'branch_office_celebrate_id', 'id');
    }
}

