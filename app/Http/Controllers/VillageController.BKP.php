<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Helpers\Helper;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BuildingRequest;
use Illuminate\Support\Facades\Storage;

class VillageController extends Controller
{
    private $compact;
    private $helper;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->helper  = new Helper();

        $buildings     = config( "game_buildings" );
        $units         = config( "game_units"     );

        $this->compact = [
            "buildings" => $buildings,
            "units"     => $units,
        ];
    }

    /**
     * Tela principal
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function overview( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.overview", $this->compact );
    }

    /**
     * Tela edificio principal
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function main( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.main", $this->compact );
    }

    /**
     * Tela quartel
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function barracks( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village   );
        $this->getUnits( "barracks" );

        return view( "users.player.buildings.barracks", $this->compact );
    }

    /**
     * Tela estabulo
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function stable( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );
        $this->getUnits( "stable" );

        return view( "users.player.buildings.stable", $this->compact );
    }

    /**
     * Tela oficina
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function workshop( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village   );
        $this->getUnits( "workshop" );

        return view( "users.player.buildings.workshop", $this->compact );
    }

    /**
     * Tela forja
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function smithy( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );
        $this->getUnits( "smithy" );

        return view( "users.player.buildings.smithy", $this->compact );
    }

    /**
     * Tela igreja
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function church( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.church", $this->compact );
    }

    /**
     * Tela academia
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function academy( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.academy", $this->compact );
    }

    /**
     * Tela praça de reuniao
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function place( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.place", $this->compact );
    }

    /**
     * Tela estatua
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function statue( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.statue", $this->compact );
    }

    /**
     * Tela mercado
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function market( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.market", $this->compact );
    }

    /**
     * Tela madeireira
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function wood( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.wood", $this->compact );
    }

    /**
     * Tela poço de argila
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clay( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.clay", $this->compact );
    }

    /**
     * Tela mina de ferro
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function iron( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.iron", $this->compact );
    }

    /**
     * Tela fazenda
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function farm( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.farm", $this->compact );
    }

    /**
     * Tela armazem
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function warehouse( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.warehouse", $this->compact );
    }

    /**
     * Tela esconderijo
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hide( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.hide", $this->compact );
    }

    /**
     * Tela muralha
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function wall( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.wall", $this->compact );
    }

    /**
     * Tela torre de vigia
     *
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function watchtower( Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        return view( "users.player.buildings.watchtower", $this->compact );
    }




    /**
     * Atualiza o nível do edifício
     *
     * @param Village $village
     * @param string $unit
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function researchUnit( Village $village, string $unit )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );
        $this->getUnits( "smithy" );

        $currLvl = $village->{ "research_{$unit}" };

        $unit    = ( isset( $this->compact[ "unitsOn" ][ $unit ] ) )
                    ? $this->compact[ "unitsOn"  ][ $unit ]
                    : $this->compact[ "unitsOff" ][ $unit ];

        $maxLvl  = $unit[ "max_level" ];

        if ( $currLvl < $maxLvl )
        {
            if ( $unit[ "research_wood" ] <= $village->stored_wood &&
                 $unit[ "research_clay" ] <= $village->stored_clay &&
                 $unit[ "research_iron" ] <= $village->stored_iron )
            {
                $village->stored_wood -= ( int ) $unit[ "research_wood" ];
                $village->stored_clay -= ( int ) $unit[ "research_clay" ];
                $village->stored_iron -= ( int ) $unit[ "research_iron" ];
                $village->{ "research_{$unit[ "key" ] }" } += 1;
                $village->save();
            }
        }

        return redirect()->route( "village.smithy", [ "village" => $village ] );
    }

    public function trainUnit( Request $request, Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        dd( $request->all() );
    }

    /**
     * Atualiza o nível do edifício
     *
     * @param Village $village
     * @param string $building
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function upgradeBuilding( BuildingRequest $request, Village $village, string $building )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $events = Event::where( "village_id", $village->id )->where( "type", 2 )->get();

        // msg de erro
        // fila cheia
        // if ( $events->count() >= 5 )
        //     return redirect()->route( "village.main", [ "village" => $village ] );

        $this->getInfos( $village );

        $auxVlg   = $this->compact[ "village" ];

        $building = ( property_exists( $auxVlg->buildings->on, $building ) )
                    ? $auxVlg->buildings->on->$building
                    : $auxVlg->buildings->off->$building;

        $currLvl  = $building->level;
        $maxLvl   = $building->max_level;

        if ( $currLvl < $maxLvl )
        {
            // free pop
            $fp = $auxVlg->buildings->on->farm->max_pop - $auxVlg->pop;

            $w  = ( int ) $building->wood == ( int ) $request->wood;
            $c  = ( int ) $building->clay == ( int ) $request->clay;
            $i  = ( int ) $building->iron == ( int ) $request->iron;
            $p  = $building->pop  <= $fp || $building->pop == 0;

            if ( $w && $c && $i && $p )
            {
                $new_wood  = 0;
                $new_clay  = 0;
                $new_iron  = 0;

                $resources = $this->helper->processStoredResourceTwoVillages( $village, $auxVlg );

                foreach ( $resources as $key => $value ) ${"new_{$key}"} = $value;

                if ( $new_wood >= $building->wood &&
                     $new_clay >= $building->clay &&
                     $new_iron >= $building->iron )
                {
                    $village->updated_stored  = now();
                    $village->stored_wood     = $new_wood - $building->wood;
                    $village->stored_clay     = $new_clay - $building->clay;
                    $village->stored_iron     = $new_iron - $building->iron;
                    $village->pop            += ( int ) $building->pop;
                    $village->save();

                    // add event
                    $duration = ( int ) $building->build_time_final;
                    $start    = ( $events->count() > 0 ) ? Carbon::parse( $events->last()->finish )->toImmutable() : Carbon::now()->toImmutable();
                    $finish   = $start->addSeconds( $duration );

                    $event    = Event::create( [
                        "village_id" => $village->id,
                        "type"       => Event::BUILDING,
                        "start"      => $start,
                        "finish"     => $finish,
                        "duration"   => $duration
                    ] );

                    DB::table( "events_buildings" )->insert( [
                        "event_id"   => $event->id,
                        "technology" => $building->key,
                        "wood"       => $building->wood,
                        "clay"       => $building->clay,
                        "iron"       => $building->iron,
                        "created_at" => now(),
                        "updated_at" => now(),
                    ] );

                    // success
                    $result = redirect()->route( "village.main", [ "village" => $village ] );
                }
                else
                {
                    // msg de erro
                    // recursos indisponiveis
                    $result = redirect()->route( "village.main", [ "village" => $village ] );
                }
            }
            else
            {
                // msg de erro
                // recursos indisponiveis | diferenca entre requisito e informado
                $result = redirect()->route( "village.main", [ "village" => $village ] );
            }
        }
        else
        {
            // msg de erro
            // edificio no nivel maximo
            $result = redirect()->route( "village.main", [ "village" => $village ] );
        }

        return $result;
    }

    public function cancelUpgradeBuilding( Request $request, Village $village, Event $event )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        $this->getInfos( $village );

        $index  = 0;
        $events = $village->buildEvents;

        foreach ( $events as $i => $ev )
        {
            if ( $ev->id == $event->id )
            {
                $index = $i;
                $event = $ev;
                break;
            }
        }

        if ( $index == 0 )
        {
            // apenas remover da fila
            DB::table( "events_buildings" )->where( "event_id", $event->id )->delete();
            DB::table( "events"           )->where( "id",       $event->id )->delete();

            // // restituir recursos
            // $resources               = $this->helper->restoreResources( $village, $this->compact[ "village" ], $event );
            // $village->stored_wood    = $resources[ "wood" ];
            // $village->stored_clay    = $resources[ "clay" ];
            // $village->stored_iron    = $resources[ "iron" ];
            // $village->updated_stored = now();
            // $village->save();

            $i     = 1;
            $count = $events->count();

            do
            {
                if ( isset( $events[ $i ] ) )
                {
                    $auxEv         = $events[ $i ];

                    $start         = ( $i == 1 ) ? Carbon::now()->toImmutable() : Carbon::parse( $events[ $i - 1 ]->finish )->toImmutable();
                    $finish        = $start->addSeconds( $auxEv->total_time );

                    $originals     = $auxEv->getOriginal();
                    $attributes    = $auxEv->getAttributes();

                    foreach ( $attributes as $key => $value )
                        if ( !isset( $originals[ $key ] ) )
                            unset( $auxEv->$key );

                    $auxEv->start    = $start;
                    $auxEv->finish   = $finish;
                    $auxEv->duration = $auxEv->total_time;
                    $auxEv->save();

                    $i++;
                }
            }
            while ( $i < $count );

            return redirect()->route( "village.main", [ "village" => $village ] );
        }
        else
        {

        }

        // $before = $index - 0;
        // $after  = $index + 1;

        // dd( $index, $events, isset( $events[ $before ] ), isset( $events[ $after ] ) );

        // $building = "";

        // $index  = 0;
        // $event  = null;

        // foreach ( $events as $i => $ev )
        // {
        //     if ( $ev->technology == $building )
        //     {
        //         $event = $ev;
        //         $index = $i;
        //     }
        // }

        // $resources               = $this->helper->processStoredResourceTwoVillages( $village, $this->compact[ "village" ] );
        // $village->stored_wood    = $resources[ "wood" ] + $event->wood;
        // $village->stored_clay    = $resources[ "clay" ] + $event->clay;
        // $village->stored_iron    = $resources[ "iron" ] + $event->iron;
        // $village->updated_stored = now();
        // $village->save();

        // if ( $events->count() != $index + 1 )
        // {
        //     $bFinish = now();

        //     if ( $index != 0 )
        //     {
        //         $eventBefore = $events[ $index - 1 ];
        //         $bFinish     = $eventBefore->finish;
        //     }

        //     $eventAfter         = $events[ $index + 1 ];

        //     $aFinish            = Carbon::parse( $eventAfter->finish )->toImmutable();
        //     $aStart             = Carbon::parse( $eventAfter->start )->toImmutable();

        //     $diff               = $aFinish->diffInSeconds( $aStart );

        //     $eventAfter->start  = Carbon::parse( $bFinish )->toImmutable();
        //     $eventAfter->finish = $eventAfter->start->addSeconds( $diff );
        //     $eventAfter->save();
        // }

        // DB::table( "events_buildings" )->where( "event_id", $event->id )->delete();
        // DB::table( "events"           )->where( "id",       $event->id )->delete();

        // return redirect()->route( "village.main", [ "village" => $village ] );
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Village $village
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changeVillageName( Request $request, Village $village )
    {
        if ( $this->checkVillageUser( $village ) ) return redirect()->back();

        if ( $village->name != $name = $request->name )
        {
            $village->name = $name;
            $village->save();
        }

        return redirect()->route( "village.main", [ "village" => $village ] );
    }

    public function generateVillages( User $user, $num = null )
    {
        $num = ( !$num ) ? 1 : $num;

        foreach ( range( 1, $num ) as $i )
        {
            Village::create( [
                "user_id"        => $user->id,
                "name"           => "{$i} Aldeia de {$user->nickname}",
                "updated_stored" => now()
            ] );
        }

        return redirect()->back();
    }




    private function checkVillageUser( Village $village )
    {
        return ( auth()->user()->id != $village->user_id ) ? true : false;
    }

    private function getInfos( Village $village )
    {
        $this->compact[ "villages" ] = $this->helper->getVillages( $this->compact );

        foreach ( $this->compact[ "villages" ] as $v )
        {
            if ( $v->id == $village->id )
            {
                $resources = $this->helper->processStoredResourceTwoVillages( $village, $v );

                foreach ( $resources as $key => $value )
                    $v->{"stored_{$key}"} = $value;

                $data = $this->getBuildEvents( $village, $v );

                $this->compact[ "events"  ] = $data[ "events"  ];
                $this->compact[ "village" ] = $data[ "village" ];
                break;
            }
        }
    }

    private function getUnits( string $building )
    {
        $this->helper->getUnits( $this->compact, $building );
    }

    private function getBuildEvents( Village $village, Village $aux )
    {
        $queue   = [];
        $events  = $village->buildEvents;

        foreach ( $events as $key => &$event )
        {
            $event->key           = $event->technology;
            $queue[ $event->key ] = ( !isset( $queue[ $event->key ] ) ) ? 1 : $queue[ $event->key ] + 1;

            $building             = ( property_exists( $aux->buildings->on, $event->key ) )
                                    ? $aux->buildings->on->{$event->key}
                                    : $aux->buildings->off->{$event->key};

            $event->name          = $building->name;
            $event->level         = $building->level + $queue[ $event->key ];

            $carbon               = Carbon::createFromFormat( "Y-m-d H:i:s", $event->finish )->toImmutable();
            $tomorrow             = Carbon::tomorrow()->format( "Y-m-d" );
            $isTomorrow           = $carbon->eq( $tomorrow );

            if ( $carbon->isToday() )
                $event->conclusion = "Hoje às " . $carbon->format( "H:i:s" );
            else if ( $isTomorrow )
                $event->conclusion = "Amanhã às " . $carbon->format( "H:i:s" );
            else
                $event->conclusion = $carbon->format( "d/m" ) . " às " . $carbon->format( "H:i:s" );

            $event->duration_f = gmdate( "H:i:s", $event->duration );
            $event->total_time = $event->duration;
            $event->duration   = strtotime( $event->finish ) - strtotime( Carbon::now() );

            if ( $event->duration <= 0 )
            {
                // remover da fila
                unset( $events[ $key ] );
                DB::table( "events_buildings" )->where( "event_id", $event->id )->delete();
                DB::table( "events"           )->where( "id",       $event->id )->delete();

                // atualizar edificio
                $bk                = "building_{$building->key}";

                $village->$bk     += 1;
                $village->points  += ( int ) $building->points;
                $village->save();

                $aux->$bk          = $village->$bk;
                $aux->points       = $village->points;

                if ( $queue[ $event->key ] == 1 )
                    unset( $queue[ $event->key ] );
                else
                    $queue[ $event->key ] -= 1;
            }
        }

        foreach ( $queue as $key => $qtty )
            $aux = $this->helper->calcBuildingsProps( $aux, $key );

        return [
            "events"  => $events,
            "village" => $aux,
        ];
    }
}
