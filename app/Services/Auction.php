<?php

namespace App\Services;

use App\Models\Auction as AuctionModel;
use Illuminate\Support\Facades\DB;

class Auction {

    /**
     * updateAuction 
     * @param AuctionModel $auction
     */
    public static function updateAuction(AuctionModel $auction)
    {
        return $auction;
        // $auction->update([
        //     'a_status' => AuctionModel::STATUS_STARTED, 
        // ]);
    }

}