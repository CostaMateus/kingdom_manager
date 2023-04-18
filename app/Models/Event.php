<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    const ARMY     = 1;
    const BUILDING = 2;
    const RESEARCH = 3;
    const BARRACKS = 4;
    const STABLE   = 5;
    const WORKSHOP = 6;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "village_id",

        /**
         * 1 - army
         * 2 - building
         * 3 - research
         * 4 - train barracks
         * 5 - train stable
         * 6 - train workshop
         */
        "type",
        "start",
        "finish",
        "duration",
    ];

    public function village()
    {
        return $this->belongsTo( Village::class );
    }

}
