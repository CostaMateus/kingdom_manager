<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

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
         * 4 - train
         */
        "type",
        "start",
        "finish",
    ];

    public function village()
    {
        return $this->belongsTo( Village::class );
    }

}
