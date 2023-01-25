
@section( "js" )

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        window.onload = function() {
            let max    = parseInt( "{{ ( int ) $buildingsOn[ "warehouse" ][ "capacity" ] }}"    );

            let p_wood = parseInt( "{{ ( int ) $village->prod_wood * config( "game.speed" ) }}" );
            let p_clay = parseInt( "{{ ( int ) $village->prod_clay * config( "game.speed" ) }}" );
            let p_iron = parseInt( "{{ ( int ) $village->prod_iron * config( "game.speed" ) }}" );

            let s_wood = parseInt( "{{ ( int ) $village->stored_wood }}" );
            let s_clay = parseInt( "{{ ( int ) $village->stored_clay }}" );
            let s_iron = parseInt( "{{ ( int ) $village->stored_iron }}" );

            setInterval( getResources, 1000 );

            function getResources()
            {
                if ( s_wood < max ) s_wood = parseInt( s_wood + ( p_wood / 60 ) );
                if ( s_clay < max ) s_clay = parseInt( s_clay + ( p_clay / 60 ) );
                if ( s_iron < max ) s_iron = parseInt( s_iron + ( p_iron / 60 ) );

                if ( s_wood >= ( 0.9 * max ) ) $( "#stored_wood" ).addClass( "text-danger" );
                if ( s_clay >= ( 0.9 * max ) ) $( "#stored_clay" ).addClass( "text-danger" );
                if ( s_iron >= ( 0.9 * max ) ) $( "#stored_iron" ).addClass( "text-danger" );

                $( "#stored_wood span" ).text( s_wood );
                $( "#stored_clay span" ).text( s_clay );
                $( "#stored_iron span" ).text( s_iron );

                console.log( s_wood, s_clay, s_iron );
            }
        };
    </script>
@endsection
