
                        <div class="row" >
                            @php
                                $key   = $building[ "key" ];
                                $key2  = "building_{$key}";
                                $level = ( $village->$key2 != 0 ) ? "Nível {$village->$key2}" : "não construído";
                                $png   = Helper::getLevelImage( $key, $village->$key2 );
                                $img   = "{$key}{$png}.png";
                            @endphp
                            <div class="col-12 col-sm-4 col-md-3 col-lg-2 text-center my-auto" >
                                <img src="{{ asset( "assets/graphic/buildings/{$img}" ) }}" alt="{{ $building[ "name" ] }}" >
                            </div>
                            <div class="col-12 col-sm-8 col-md-9 col-lg-10 mt-3 mt-sm-0" >
                                <p class="h3 mb-2" >
                                    <b>{{ $building[ "name" ] }} ({{ $level }})</b>
                                </p>
                                <p class="h5 mb-0" >
                                    {{ $building[ "description" ] }}
                                </p>
                            </div>
                        </div>
