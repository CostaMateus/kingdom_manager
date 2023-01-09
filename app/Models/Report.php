<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "from_village_id",
        "to_village_id",
        "type",
        "is_read",
        "data",
    ];

    public function user()
    {
        return $this->belongsTo( User::class );
    }

    public function village()
    {
        return $this->belongsTo( Village::class, "id", "from_village_id" );
    }

}
