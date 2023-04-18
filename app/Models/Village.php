<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "name",

        "x",
        "y",
        "map_sector",
        "points",
        "loyalty",

        "prod_wood",
        "prod_clay",
        "prod_iron",

        "pop",

        "stored_wood",
        "stored_clay",
        "stored_iron",

        "building_main",
        "building_barracks",
        "building_stable",
        "building_workshop",
        "building_church",
        "building_academy",
        "building_smithy",
        "building_place",
        "building_statue",
        "building_market",
        "building_wood",
        "building_clay",
        "building_iron",
        "building_farm",
        "building_warehouse",
        "building_hide",
        "building_wall",
        "building_watchtower",

        "research_spear",
        "research_sword",
        "research_axe",
        "research_archer",
        "research_spy",
        "research_light",
        "research_marcher",
        "research_heavy",
        "research_ram",
        "research_catapult",

        "cached_population",
    ];

    public function user()
    {
        return $this->belongsTo( User::class );
    }

    public function army()
    {
        return $this->hasOne( Army::class, "from_village_id" );
    }

    public function events()
    {
        return $this->hasMany( Event::class );
    }

    public function reports()
    {
        return $this->hasMany( Report::class, "from_village_id" );
    }

    public function armyEvents()
    {
        return $this->hasMany( Event::class )->where( "type", 1 )->join( "events_buildings", "events.id", "=", "events_buildings.event_id" );
    }

    public function buildEvents()
    {
        return $this->hasMany( Event::class )->where( "type", 2 );
    }

    public function buildEventsFull()
    {
        return $this->hasMany( Event::class )->where( "type", 2 )->join( "events_buildings", "events.id", "=", "events_buildings.event_id" );
    }

    public function researchEvents()
    {
        return $this->hasMany( Event::class )->where( "type", 3 )->join( "events_buildings", "events.id", "=", "events_buildings.event_id" );
    }

    public function barracksTrainEvents()
    {
        return $this->hasMany( Event::class )->where( "type", 4 )->join( "events_buildings", "events.id", "=", "events_buildings.event_id" );
    }

    public function stableTrainEvents()
    {
        return $this->hasMany( Event::class )->where( "type", 5 )->join( "events_buildings", "events.id", "=", "events_buildings.event_id" );
    }

    public function workshopTrainEvents()
    {
        return $this->hasMany( Event::class )->where( "type", 6 )->join( "events_buildings", "events.id", "=", "events_buildings.event_id" );
    }

}
