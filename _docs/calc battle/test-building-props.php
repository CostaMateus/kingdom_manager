<?php

    $buildings = config( "game_buildings" );

    $total    = 0;

    foreach ( $buildings as $building )
    {
        $subtotal = 0;

        echo "<br><br><br>";
        echo "{$building[ "name" ]}<br>";

        $attr1 = "pop";
        $attr2 = "pop_factor";

        $base = $building[ $attr1 ];
        $rate = $building[ $attr2 ];
        $cal  = 0;

        $subtotal += $base;

        echo "lvl 0 => 1 __ {$base}/{$base}<br>";

        foreach ( range( 1, $building[ "max_level" ] - 1 ) as $i )
        {
            $cal   = $base * $rate;
            $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
            $base3 = $base2 - ( round( $base, 0, PHP_ROUND_HALF_DOWN ) );
            $base  = $cal;

            $subtotal += $base3;

            $y = $i + 1;

            echo "lvl {$i} => {$y} __ {$base3}/{$base2}<br>";
        }

        echo "SUBTOTAL = {$subtotal}<br>";

        $total += $subtotal;
    }

    echo "<br><br>";
    echo "TOTAL = {$total}<br><br><br><br><br><br><br>.";
