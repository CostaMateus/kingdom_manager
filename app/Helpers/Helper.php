<?php

namespace App\Helpers;

use App\Models\Event;
use App\Models\Village;
use Illuminate\Support\Carbon;

class Helper
{
    public function getResourceSpeed()
    {
        return config( "game.speed_resource" );
    }

    public function getBuildSpeed()
    {
        return config( "game.speed_build" );
    }
}
