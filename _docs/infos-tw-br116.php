<?php

    $url_config    = "https://br116.tribalwars.com.br/interface.php?func=get_config";
    $url_units     = "https://br116.tribalwars.com.br/interface.php?func=get_unit_info";
    $url_buildings = "https://br116.tribalwars.com.br/interface.php?func=get_building_info";

    $response      = Http::get( $url_units );

    if( !$response->successful() ) dd( $response );

    $xml          = simplexml_load_string( $response->body(), "SimpleXMLElement", LIBXML_NOCDATA );
    $json         = json_encode( $xml );

    $data         = json_decode( $json, true );

    dd( $json );
    dd ( $data );
