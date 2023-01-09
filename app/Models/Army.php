<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Army extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "from_village_id",
        "to_village_id",
        "spear",
        "sword",
        "axe",
        "archer",
        "spy",
        "light",
        "marcher",
        "heavy",
        "ram",
        "catapult",
        "paladin",
        "noble",
    ];

    public function village()
    {
        return $this->belongsTo( Village::class, "id", "from_village_id" );
    }

}
