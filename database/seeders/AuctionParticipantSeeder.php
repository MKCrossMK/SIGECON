<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\AuctionParticipant;
use App\Models\ParticipantOnAuction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuctionParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $participant = AuctionParticipant::create([
            'name' => AuctionParticipant::MDP['name'],
            'cedula' =>  AuctionParticipant::MDP['cedula'],
            'user_creator_id' => 1, 
        ]);

       $auction = Auction::create([
            
            'date_to_celebrate' => date('Y-m-d'),
            'places' => 0,
            'branch_office_celebrate_id' => 1,
            'user_creator_id' => 1,
            'status' => 0,
            'a_status' => 'Nula',
        ]);

        ParticipantOnAuction::create([
            'auction_participant_id' => $participant->id,
            'number_paddle' => 0,
            'auction_id' => $auction->id
        ]);
    }
}
