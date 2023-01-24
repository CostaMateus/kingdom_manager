
@section( "js" )

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/8.0/pusher.min.js"></script>
    <script>
        let a_tok = document.querySelector('meta[name="csrf-token"]').content;

        //suscribing to pusher channel
        Pusher.logToConsole = false;
        var pusher = new Pusher( "123123", {
            broadcaster: 'pusher',
            key: "{{ env( "PUSHER_APP_KEY" ) }}",
            cluster: "{{ env( "PUSHER_APP_CLUSTER" ) }}",
            forceTLS: false,
            wsHost: window.location.hostname,
            wsPort: 6001,
            enabledTransports: ['ws', 'wss'],
        });

        var channel = pusher.subscribe( "events" );
        channel.bind( "App\\Events\\RealTimeMessage", ( d ) => {

            let id   = parseInt( "{{ $village->id }}" );
            let data = JSON.parse( d.data );

            if ( data.village.id == id )
            {
                console.log( data );

                let w = parseInt( data.village.stored_wood );
                let c = parseInt( data.village.stored_clay );
                let i = parseInt( data.village.stored_iron );

                let stored = parseInt( "{{ ( int ) $buildingsOn[ "warehouse" ][ "capacity" ] }}" );

                if ( w >= ( 0.9 * stored ) ) $( "#stored_wood" ).addClass( "text-danger" );
                if ( i >= ( 0.9 * stored ) ) $( "#stored_clay" ).addClass( "text-danger" );
                if ( c >= ( 0.9 * stored ) ) $( "#stored_iron" ).addClass( "text-danger" );

                $( "#stored_wood span" ).text( w );
                $( "#stored_clay span" ).text( c );
                $( "#stored_iron span" ).text( i );
            }
        } );
    </script>

@endsection
