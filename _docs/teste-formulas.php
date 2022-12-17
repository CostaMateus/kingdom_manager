<?php

    // ================================
    // tempo decrescido do tempo de construção
    // aumento conforme evolução do edificio principal
    $base = 95;
    $rate = -0.049;
    $time = [ $base ];
    echo "1 __ $base __ 0<br>";
    foreach ( range( 2, 30 ) as $i )
    {
        $cal    = $base * $rate;
        $base   = $base + round( $cal, 0, PHP_ROUND_HALF_DOWN );
        $time[] = $base;
        echo "$i __ $base __ $cal<br>";
    }


    // ================================
    // tempo de construção padrão
    echo "<br><br><br>";
    $base = 563;
    $rate = 1.2;
    $cal  = 0;
    $aux  = sprintf('%02d:%02d:%02d', ( $base / 3600 ),( $base / 60 % 60 ), ( $base % 60 ) );
    echo "0 __ $aux __ $cal<br>";
    foreach ( range( 2, 30 ) as $i )
    {
        $base = $base * $rate;
        $cal  = round( $base, 0, PHP_ROUND_HALF_DOWN );

        $aux  = sprintf('%02d:%02d:%02d', ( $base / 3600 ),( $base / 60 % 60 ), ( $base % 60 ) );
        echo "$i __ $aux __ $cal<br>";
    }

    // tempo de construção com bônus de diminuição de tempo
    echo "<br>";
    $base = 563;
    $rate = 1.2;
    $cal  = 0;
    $aux  = sprintf('%02d:%02d:%02d', ( $base / 3600 ),( $base / 60 % 60 ), ( $base % 60 ) );
    echo "lvl 1 __ $aux __ $cal<br>";
    foreach ( range( 2, 30 ) as $i )
    {
        $base = $base * $rate;

        $perc = 100 - $time[ $i - 1 ];
        $cal  = $base - ( ( $base * $perc ) / 100 );
        $cal  = round( $cal, 0, PHP_ROUND_HALF_DOWN );

        $aux  = sprintf('%02d:%02d:%02d', ( $cal / 3600 ),( $cal / 60 % 60 ), ( $cal % 60 ) );
        echo "lvl $i __ $aux __ $cal<br>";
    }


    // ================================
    // TROPAS
    // ataque
    echo "<br><br><br>";
    echo "wood<br>";
    $base = 90;
    $rate = 1.25;
    $cal  = 0;
    echo "0 __ $base __ $cal<br>";
    foreach ( range( 2, 3 ) as $i )
    {
        $cal  = $base * $rate;
        $base = $cal;
        $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
        echo "$i __ $base2 __ $cal<br>";
    }

    // defesa
    echo "<br><br><br>";
    echo "clay<br>";
    $base = 1;
    $rate = 1.25;
    $cal  = 0;
    echo "0 __ $base __ $cal<br>";
    foreach ( range( 2, 3 ) as $i )
    {
        $cal  = $base * $rate;
        $base = $cal;
        $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
        echo "$i __ $base2 __ $cal<br>";
    }

    // defesa cavalaria
    echo "<br><br><br>";
    echo "iron<br>";
    $base = 2;
    $rate = 1.25;
    $cal  = 0;
    echo "0 __ $base __ $cal<br>";
    foreach ( range( 2, 3 ) as $i )
    {
        $cal  = $base * $rate;
        $base = $cal;
        $base2 = round( $cal, 0, PHP_ROUND_HALF_DOWN );
        echo "$i __ $base2 __ $cal<br>";
    }
