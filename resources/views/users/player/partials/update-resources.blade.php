
@section( "js" )

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        window.onload = function() {
            let max    = parseFloat( "{{ $village->buildings->on->warehouse->capacity }}" );

            let p_wood = parseFloat( "{{ $village->prod_wood }}" );
            let p_clay = parseFloat( "{{ $village->prod_clay }}" );
            let p_iron = parseFloat( "{{ $village->prod_iron }}" );

            let s_wood = parseFloat( "{{ $village->stored_wood }}" );
            let s_clay = parseFloat( "{{ $village->stored_clay }}" );
            let s_iron = parseFloat( "{{ $village->stored_iron }}" );

            setInterval( getResources, 1000 );

            function getResources()
            {
                if ( s_wood < max ) s_wood = s_wood + ( p_wood / 60 / 60 );
                if ( s_clay < max ) s_clay = s_clay + ( p_clay / 60 / 60 );
                if ( s_iron < max ) s_iron = s_iron + ( p_iron / 60 / 60 );

                if ( s_wood >= ( 0.9 * max ) ) $( "#stored_wood" ).addClass( "text-danger" );
                if ( s_clay >= ( 0.9 * max ) ) $( "#stored_clay" ).addClass( "text-danger" );
                if ( s_iron >= ( 0.9 * max ) ) $( "#stored_iron" ).addClass( "text-danger" );

                $( "#stored_wood span" ).text( parseInt( s_wood ) );
                $( "#stored_clay span" ).text( parseInt( s_clay ) );
                $( "#stored_iron span" ).text( parseInt( s_iron ) );
            }
        };
    </script>
@endsection
