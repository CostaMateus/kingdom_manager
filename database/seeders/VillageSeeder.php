<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Village;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = User::all();

        foreach ( $players as $player )
        {
            Village::create( [
                "user_id" => $player->id,
                "name"    => "Aldeia de {$player->nickname}"
            ] );
        }
    }
}
